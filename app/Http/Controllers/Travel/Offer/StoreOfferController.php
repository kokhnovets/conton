<?php

namespace App\Http\Controllers\Travel\Offer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Travel\Offer\StoreOfferRequest;
use App\Mail\Offer\OfferMail;
use App\Models\OfferForDelivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StoreOfferController extends Controller
{
    // Создание предложения
    public function storeOffer(Order $order, StoreOfferRequest $request) {
        $validated = $request->validated(); // Валидация форм
        if ($validated) { // Если валидация прошла
            $validated['user_id'] = auth()->id(); // Добавление в масив идентификатора пользователя
            $validated['order_id'] = $order->id;// Добавление в масив идентификатора заказа
            $offer = $order->offers()->create($validated); // Сохранение в БД
            $user = User::find($order->user_id); // Поиск пользователя
            Mail::to($user)->send(new OfferMail($order, $offer)); // Отправка пользователю с уведомлением о новом предложении
            return response()->json(["status" => true]); // Ответ
        } else {
            // Если валидация не прошла, возвращается ответ с ошибками валидации
            return response()->json([
                'error' => $validated->errors()
            ], 422);
        }
    }
}
