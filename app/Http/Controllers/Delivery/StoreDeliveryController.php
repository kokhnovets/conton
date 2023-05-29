<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Mail\Delivery\DeliveryMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StoreDeliveryController extends Controller
{
    public function storeDeliveries(Request $request, Order $order) {
        $total = $order->price * $order->count; // Перерасчёт количества и суммы
        $commission = $total * 0.075; // Комиссия
        $total += $commission + $request->offer; // Перерасчёт итоговой суммы
        $order->fill([ // Замена данных на новые
            'award' => $request->offer,
            'total' => $total,
            'order_status' => 1
        ]);
        $order->save(); // Сохранение данных о заказе в БД
        $delivery = $order->delivery()->withTrashed()
            // Если покупатель отменил доставку и выбрал того же перевозчика,
            // то просто идёт восстановление данных в БД
            ->where('order_id', $order->id)
            ->where('user_id', $request->user_id);
        if ($delivery->exists()) {
            $delivery->restore();
        } else {
            // Создание доставки заказа
            $order->delivery()->create([
                'order_id' => $order->id,
                'user_id' => $request->user_id
            ]);
        }
        $userDelivery = User::find($request->user_id);
        Mail::to($userDelivery)->send(new DeliveryMail($order));
        // Редирект на страницу с актуальнымми заказом
        return redirect()->route('user.orders.active.detail', $order->id);
    }
}
