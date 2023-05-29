<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Mail\Delivery\DeliveryMail;
use App\Mail\Delivery\RevokeDeliveryMail;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DestroyDeliveryController extends Controller
{
    public function destroyDeliveries(Order $order) {
        $statusesExists = $order->statuses()->exists();
        if ($statusesExists) {
            return redirect()->back();
        } else {
            $delivery = $order->delivery()->firstOrFail();
            $user = User::find($delivery->user->id);
            Mail::to($user)->send(new RevokeDeliveryMail($order));
            $delivery->delete();
            $order->fill([
                'order_status' => 0
            ]);
            $order->save();
            return redirect()->route('user.orders.posted.detail', $order->id);
        }
    }
}
