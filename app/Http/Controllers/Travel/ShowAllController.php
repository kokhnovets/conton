<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowAllController extends Controller
{
    // Функция выводит все актуальные заказы, в котором 'order_status' со значением 0,
    // также он не учитывает заказы авторизованного пользователя и выводит также количество заказов:
    public function showAllOrders() {
        return view('travel.travel', [
            'orders' => Order::where('order_status', '=', 0)
                ->where('user_id', '<>', auth()->id())
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->whereNull('users.banned_at')
                ->latest('orders.created_at') // явно указываем 'orders.created_at'
                ->paginate(10),
            'count' => Order::where('order_status', '=', 0)
                ->where('user_id', '<>', auth()->id())
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->whereNull('users.banned_at')
                ->count()
        ]);
    }
}
