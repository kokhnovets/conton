<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ShowDetailAdminUserController extends Controller
{
//    Отображение всех заказов пользователя
    public function orders(User $user) {
        $orders = Order::where('user_id', $user->id)->get();
        return view('admin_panel.users.orders.orders', ['user' => $user, 'orders' => $orders]);
    }
//    Отображение всех доставок пользователя
    public function deliveries(User $user) {
        $orders = Order::join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->where('deliveries.user_id', $user->id)->where('deliveries.deleted_at', null)->select('orders.*')->get();
        return view('admin_panel.users.deliveries.deliveries', ['user' => $user, 'orders' => $orders]);
    }
}
