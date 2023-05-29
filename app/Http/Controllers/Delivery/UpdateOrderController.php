<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Mail\Delivery\DeliveryMail;
use App\Mail\Delivery\SuccessDeliveryMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UpdateOrderController extends Controller
{
    public function sussesDeliveries(Order $order) {
        $order->fill([
           'order_status' => 2
        ]);
        $delivery = $order->delivery()->where('order_id', $order->id)->firstOrFail();
        $delivery->fill([
            'order_is_completed' => true
        ]);
        $user = User::find($delivery->user->id);
        Mail::to($user)->send(new SuccessDeliveryMail($order));
        $delivery->save();
        $order->save();
        return redirect()->route('user.orders.completed.detail', $order->id);
    }
}
