<?php

namespace Tests\Feature\User\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    // Маршрут настроек
    protected function settingsGetRoute()
    {
        return route('user.settings');
    }
    // Маршрут авторизации
    protected function loginPostRoute()
    {
        return route('login');
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
    // Маршрут страницы настроек профиля
    protected function settingsProfileGetRoute()
    {
        return route('user.settings.profile');
    }
    // Маршрут страницы настроек деталей аккаунта
    protected function settingsDetailsGetRoute()
    {
        return route('user.settings.details');
    }
    // Маршрут страницы настроек телефона
    protected function settingsPhoneGetRoute()
    {
        return route('user.settings.phone');
    }
    // Маршрут изменения настроек профиля
    protected function settingsProfilePostRoute()
    {
        return route('user.update.profile');
    }
    // Маршрут изменения настроек деталей аккаунта
    protected function settingsDetailsPostRoute()
    {
        return route('user.update.details');
    }
    // Маршрут изменения настроек телефона
    protected function settingsPhonePostRoute()
    {
        return route('user.update.phone');
    }
    // Открытие настроек пользователя
    public function testShowSettings(): void
    {
        $this->generateAndAuthorizedUser();
        $response = $this->get($this->settingsGetRoute());
        // Проверка статуса
        $response->assertStatus(200);
    }
    // Открытие раздела настроек профиля
    public function testShowProfileSettings(): void
    {
        $this->generateAndAuthorizedUser();
        $response = $this->get($this->settingsProfileGetRoute());
        // Проверка статуса
        $response->assertStatus(200);
    }
    // Открытие раздела настроек деталей аккаунта
    public function testShowDetailSettings(): void
    {
        $this->generateAndAuthorizedUser();
        $response = $this->get($this->settingsDetailsGetRoute());
        // Проверка статуса
        $response->assertStatus(200);
    }
    // Открытие раздела настроек телефона
    public function testShowPhoneSettings(): void
    {
        $this->generateAndAuthorizedUser();
        $response = $this->get($this->settingsPhoneGetRoute());
        // Проверка статуса
        $response->assertStatus(200);
    }
    // Обновление профиля
    public function testUpdateProfileSettings(): void
    {
        $user = $this->generateAndAuthorizedUser();

        $file = UploadedFile::fake()->image('avatar.jpeg');
        $update_profile = [
            'photo_profile_path' => $file,
            'first_name' => 'Антон',
            'last_name' => 'Антонов',
            'about_me' => 'О себе ляляляляля',
            'where_from' => 'Таджикистан',
            'where' => 'Армения',
        ];
        // Обновление данных
        $this->patch($this->settingsProfilePostRoute(), $update_profile);
        $user->refresh();
        // Сравнение данных
        $this->assertEquals('Антон', $user->first_name);
        $this->assertEquals('Антонов', $user->last_name);
        $this->assertEquals('О себе ляляляляля', $user->about_me);
        $this->assertEquals('Таджикистан', $user->where_from);
        $this->assertEquals('Армения', $user->where);
        // Проверка существования изображения
        $this->assertTrue(Storage::exists($user->photo_profile_path));
    }
    // Обновление номера телефона
    public function testUpdatePhoneSettings(): void
    {
        $user = $this->generateAndAuthorizedUser();
        $update_phone = [
            'phone' => '79223886210',
        ];
        // Обновление данных
        $this->patch($this->settingsPhonePostRoute(), $update_phone);
        $user->refresh();
        // Сравнение данных
        $this->assertEquals('79223886210', $user->phone);
    }
    // Обновление деталей аккаунта
    public function testUpdateDetailsSettings(): void
    {
        $user = $this->generateAndAuthorizedUser();
        $update_details = [
            'email' => 'test@test.com',
            'current_password' => '123!Asdf1',
            'password' => '123!Asdf1!',
            'password_confirmation' => '123!Asdf1!',
        ];
        // Обновление данных
        $this->patch($this->settingsDetailsPostRoute(), $update_details);
        $user->refresh();
        // Сравнение данных
        $this->assertEquals('test@test.com', $user->email);
        // Сравнение паролей
        $this->assertTrue(Hash::check('123!Asdf1!', $user->password));
    }
}
