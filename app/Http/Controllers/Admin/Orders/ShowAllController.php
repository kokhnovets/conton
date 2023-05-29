<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowAllController extends Controller
{
//    Вывод всех заказов
    public function index() {
        return view('admin_panel.orders.orders', ['orders' => Order::where('order_status', 'asc')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->whereNull('users.banned_at')
            ->orderBy('order_status', 'asc')
            ->get()]);
    }
}
