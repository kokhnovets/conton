<?php

namespace App\Http\Controllers\PublicPage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowPagesController extends Controller
{
    public function showIndex() {
        $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
            ->join('deliveries', 'deliveries.order_id', '=', 'orders.id')
            ->join('users as delivery_user', 'delivery_user.id', '=', 'deliveries.user_id')
            ->select('orders.*')
            ->where('orders.order_status', 2)
            ->whereNull('orders.deleted_at')
            ->whereNull('users.deleted_at')
            ->whereNull('users.banned_at')
            ->whereNull('deliveries.deleted_at')
            ->whereNull('delivery_user.deleted_at')
            ->whereNull('delivery_user.banned_at')
            ->latest()
            ->limit(3)
            ->get();
//        dd($orders);
        return view('index', ['orders' => $orders]);
    }
    public function showAbout() {
        return view('about');
    }
}
