<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StoreOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function validateAndShowOrder(StoreOrderRequest $request) {
        // Валидация данных в пользовательском request
        $validated = $request->validated();
        // Подсчёт итоговой суммы, комиссии
        $total = $validated['price'] * $validated['count'];
        $commission = $total * 0.075;
        $total += $commission + $validated['award'];
        // Сохранение провалидированных данных в массив для последующей обработки
        $order_data = [
            'appellation' => $validated['appellation'],
            'product_link' => $validated['product_link'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'count' => $validated['count'],
            'wishes' => $validated['wishes'],
            'delivery_from' => ucfirst($validated['delivery_from']),
            'where_to_deliver' => ucfirst($validated['where_to_deliver']),
            'deliver_to' => $validated['deliver_to'],
            'award' => $validated['award'],
            'commission' => $commission,
            'total' => $total
        ];
        $paths = [];
        // Создание имени директории для изображений к заказу
        $orderDirectory = time() . '_' . auth()->id()
            . '_' . preg_replace( '/[\s,]+/', '_', $validated['delivery_from'])
            . '_' . preg_replace( '/[\s,]+/', '_', $validated['where_to_deliver']);
        // Создание директории
        Storage::makeDirectory('order_images\\' . $orderDirectory);
        // Обработка изображений и сохранение в директорию, а также сохранение имён в массив:
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imageFile) {
                $name = md5(Carbon::now() . $imageFile->getClientOriginalName()) . '.'
                    . $imageFile->getClientOriginalExtension();
                $titleImage = md5(Carbon::now() . $imageFile->getClientOriginalName());

                $dimensions = Image::make($imageFile)->getSize();
                $width = $dimensions->getWidth();
                $height = $dimensions->getHeight();
                // Реализация ресайзинга изображений:
                if ($width < 300 || $height < 300) {
                    $img = Image::canvas(400, 300, '#ffffff');
                    if ($width < 300) {
                        $x = round((300 - $width) / 2);
                        $img->insert($imageFile, 'top-left', $x, 0);
                    }
                    if ($height < 300) {
                        $y = round((300 - $height)) / 2;
                        $img->insert($imageFile, 'top-left', 0, $y);
                    }
                } else {
                    $img = Image::make($imageFile);
                    if ($width > 300 || $height > 300) {
                        $img->resize(300, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    if ($img->width() < 300 || $img->height() < 300) {
                        $newImg = Image::canvas(300, 300, '#ffffff');
                        if ($img->width() < 300) {
                            $x = round((300 - $img->width()) / 2);
                            $newImg->insert($img, 'top-left', $x, 0);
                        }
                        if ($img->height() < 300) {
                            $y = round((300 - $img->height()) / 2);
                            $newImg->insert($img, 'top-left', 0, $y);
                        }
                        $img = $newImg;
                    }
                }
                // Сохранение изображений в папку:
                $img->encode('jpg', 100)->save(storage_path('app\public\order_images\\' . $orderDirectory . '\\' . $name));

                $image = new \stdClass();
                $image->url = "order_images/$orderDirectory/$name";
                $image->title = $titleImage;
                $paths[] = $image;
            }
        }
        session(['order_data' => $order_data]);
        session(['images_data' => $paths]);
        return view('orders_crud.show_order', [
            'order' => $validated,
            'commission' => $commission,
            'total' => $total,
            'images' => $paths]);
    }

    // Создание заказа:
    public function storeOrder() {
        // Если данных в сессии нет, то перенаправляем пользователя на страницу заказа
        if (!session('order_data') && !session('order_data')) {
            return redirect()->route('order.add')->with('message', 'Произошла ошибка. Попробуйте заново сделать заказ.');
        }
        $order_data = session('order_data'); // Достаём данные из сессии
        $images_data = session('images_data'); // Достаём данные об изображениях заказа из сессии
        $order = Auth::user()->orders()->create($order_data); // Сохранение заказа в БД
        foreach ($images_data as $imageData) { // Сохранение изображений к заказу в БД
            $order->images()->create([
                'order_id' => $order->id,
                'url' => $imageData->url,
                'title' => $imageData->title
            ]);
        }
        session()->forget(['order_data', 'images_data']); // Удаление из сессии
        // Редирект на страницу с пользовательскими заказами
        return redirect()->route('user.orders')->with('message', 'Заказ успешно опубликован.');
    }
    public function revokeOrder() {
        $images_data = session('images_data'); // Достаём данные об изображениях заказа из сессии
        $imagesDataPath = $images_data[0]->url;
        // Удаление директории со всеми изображениями к заказу
        Storage::deleteDirectory(preg_replace('/\/[^\/]+$/', '', $imagesDataPath));
        // Удаление из сессии
        session()->forget(['order_data', 'images_data']);
        // Редирект на страницу с пользовательскими заказами
        return redirect()->route('user.orders')->with('message', 'Заказ отменён.');
    }
}
