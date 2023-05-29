<?php

namespace App\Http\Controllers\Delivery;

use App\Events\DeliveryStatusChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\StoreStatusRequest;
use App\Mail\Delivery\SuccessDeliveryMail;
use App\Mail\Status\StatusMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StoreStatusController extends Controller
{
    public function storeStatuses(StoreStatusRequest $request,Order $order) {
        $validated = $request->validated(); // Валидация формы
        if ($validated) { // Прроверка валидации
            $validated['order_id'] = $order->id; // Добавление идентификатора объявления
            $status = $order->statuses()->create($validated); // Добавление статуса в БД
            $user = User::find($order->user->id); // Получение данных о покупателе
            Mail::to($user)->send(new StatusMail($order, $status)); // Отправка уведомления о новом статусе покупателю
            return response()->json(["status" => true]); // Отправка успешного статуса
        } else {
            return response()->json([
                'error' => $validated->errors() // Отправка ошибок валидации
            ], 422);
        }
    }
}
