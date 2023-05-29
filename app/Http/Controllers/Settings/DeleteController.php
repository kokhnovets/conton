<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DeleteUsersRequest;
use App\Models\Image;
use App\Models\OfferForDelivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deleteUserAccount(DeleteUsersRequest $request) {
        $userId = auth()->id(); // Получение идентификатора авторизованного пользователя
        $validated = $request->validated(); // Валидация (проверка пароля на соответствие)
        if ($validated) { // Если валидация прошла успешно
            $imagesData = Image::whereHas('order', function($query) use($userId) {
                $query->where('user_id', $userId);
            }); // Получение данных с БД изображений к заказам пользователя
            $imagesData->delete(); // Удаление изображений к заказам с БД
            Order::where('user_id', $userId)->delete(); // Удаление всех заказов пользователя
            OfferForDelivery::where('user_id', $userId)->delete(); // Удаление всех предложений пользователя
            User::findOrFail($userId)->delete(); // Удаление аккаунта
            return response()->json(["redirect" => route('login')]); // Редирект
        } else {
            return response()->json([
                'error' => $validated->errors() // Отправка ошибки пользователю через JSON
            ], 422);
        }
    }
}
