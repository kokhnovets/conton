<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function showOrder(Order $order) {
        $orderExists = Order::where('id', $order->id)->where('user_id', auth()->id());
        if ($orderExists->exists()) {
            return redirect()->back();
        }
        $getAllLatestActiveOrders = Order::where([
            ['order_status', '=', 0],
            ['user_id', '<>', auth()->id()],
            ['id', '<>', $order->id]
        ])->latest()->limit(6)->get();
        $getAllLatestActiveOrdersCount = Order::where([
            ['order_status', '=', 0],
            ['user_id', '<>', auth()->id()],
            ['id', '<>', $order->id]
        ])->latest()->limit(6)->count();
        return view('travel.order_details', ['order' => $order, 'orders' => $getAllLatestActiveOrders, 'count' => $getAllLatestActiveOrdersCount]);
    }
}
