<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderTest extends TestCase
{
    // Маршрут страницы авторизации
    protected function loginPostRoute()
    {
        return route('login');
    }
    // Маршрут страницы добавления заказа
    protected function showFormAddOrderRoute()
    {
        return route('order.add');
    }
    // Маршрут валидации и сохранении данных в сессию
    protected function showOrderPostRoute()
    {
        return route('order.validate.show');
    }
    // Маршрут публикации (добавления данных в БД)
    protected function storeOrderPostRoute()
    {
        return route('order.store');
    }
    // Маршрут отмены публикации (добавления данных в БД)
    protected function revokeOrderPostRoute()
    {
        return route('order.revoke');
    }
    // Генерация пользователя
    protected function generateAndAuthorizedUser() {
        $user = User::factory()->create([
            'password' => Hash::make($password = '123!Asdf1'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);
        return $user;
    }

    // Отображение страницы добавления заказа
    public function testShowFormAddOrder(): void
    {
        $this->generateAndAuthorizedUser();
        $response = $this->get($this->showFormAddOrderRoute());
        // Проверка статуса
        $response->assertStatus(200);
    }
    public function testValidateAndShowOrder(): void
    {
        $this->generateAndAuthorizedUser();
        // Генерация фейковых изображений
        $image1 = UploadedFile::fake()->image('image1.jpg');
        $image2 = UploadedFile::fake()->image('image2.jpg');
        // Генерация данных для объявления
        $orderData = [
            'appellation' => 'Test Order',
            'product_link' => 'https://example.com/product',
            'price' => 10000.0,
            'description' => 'Test description',
            'count' => 2,
            'wishes' => 'Test wishes',
            'delivery_from' => 'Location A',
            'where_to_deliver' => 'Location B',
            'deliver_to' => '01.08.2023',
            'award' => 500.0,
            'commission' => 1500.0,
            'total' => 22000.0
        ];
        // Объединение двух массивов и отправка
        $response = $this->post($this->showOrderPostRoute(), array_merge($orderData, [
            'image' => [$image1, $image2]
        ]));
        // Проверка статуса
        $response->assertStatus(200);

        // Проверка наличия данных в сессии
        $this->assertNotNull(session('order_data'));
        $this->assertNotNull(session('images_data'));

        // Проверка соответствия сохраненных данных
        $this->assertEquals($orderData, session('order_data'));
    }
    // Добавление данных в БД
    public function testStoreOrder(): void
    {
        $user = $this->generateAndAuthorizedUser();

        // Данные для добавления в сессию
        $orderData = [
            "appellation" => "Test Order",
            "product_link" => "https://example.com/product",
            "price" => 10000.0,
            "description" => "Test description",
            "count" => 2,
            "wishes" => "Test wishes",
            "delivery_from" => "Location A",
            "where_to_deliver" => "Location B",
            "deliver_to" => "2023-08-01",
            "award" => 500.0,
            "commission" => 1500.0,
            "total" => 22000.0
        ];
        $imagesData = [
            (object) [
                'url' => 'order_images/1684746735_73_Location_A_Location_B/b0a1fdad7eed57531d2d09f3ee4fc923.jpg',
                'title' => 'b0a1fdad7eed57531d2d09f3ee4fc923',
            ],
            (object) [
                'url' => 'order_images/1684746735_73_Location_A_Location_B/67440704afccc7bf2edd19bb17660bfd.jpg',
                'title' => '67440704afccc7bf2edd19bb17660bfd',
            ],
        ];
        session(['order_data' => $orderData]);
        session(['images_data' => $imagesData]);

        // Добавление в БД
        $response = $this->post($this->storeOrderPostRoute());
        $response->assertSessionHas('message', 'Заказ успешно опубликован.');
        // Проверяем, что заказ был сохранен в базе данных
        $this->assertDatabaseHas('orders', $orderData);

        $order = Order::where('appellation', $orderData['appellation'])->first();
        $this->assertEquals($user->id, $order->user_id);
        // Проверяем, что связанные с заказом изображения были сохранены в БД
        foreach ($imagesData as $imageData) {
            $this->assertDatabaseHas('images', (array) $imageData);
        }

        // Проверяем, что данные в сессии были удалены
        $this->assertNull(session('order_data'));
        $this->assertNull(session('images_data'));
    }
    // Отмена публикации (удаление из сессии)
    public function testRevokeOrder(): void
    {
        $user = $this->generateAndAuthorizedUser();

        // Данные для добавления в сессию
        $orderData = [
            "appellation" => "Test Order",
            "product_link" => "https://example.com/product",
            "price" => 10000.0,
            "description" => "Test description",
            "count" => 2,
            "wishes" => "Test wishes",
            "delivery_from" => "Location A",
            "where_to_deliver" => "Location B",
            "deliver_to" => "2023-08-01",
            "award" => 500.0,
            "commission" => 1500.0,
            "total" => 22000.0
        ];
        $imagesData = [
            (object) [
                'url' => 'order_images/1684746735_73_Location_A_Location_B/b0a1fdad7eed57531d2d09f3ee4fc923.jpg',
                'title' => 'b0a1fdad7eed57531d2d09f3ee4fc923',
            ],
            (object) [
                'url' => 'order_images/1684746735_73_Location_A_Location_B/67440704afccc7bf2edd19bb17660bfd.jpg',
                'title' => '67440704afccc7bf2edd19bb17660bfd',
            ],
        ];
        // Сохранение данных в сессию
        session(['order_data' => $orderData]);
        session(['images_data' => $imagesData]);

        // Отмена публикации
        $this->post($this->revokeOrderPostRoute());

        // Проверяем, что данные в сессии были удалены
        $this->assertNull(session('order_data'));
        $this->assertNull(session('images_data'));
    }
}
