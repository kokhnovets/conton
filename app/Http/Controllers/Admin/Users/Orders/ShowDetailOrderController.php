<?php

namespace App\Http\Controllers\Admin\Users\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class ShowDetailOrderController extends Controller
{
//    Просмотр детали объявления пользователя
    public function order(User $user, Order $order) {
        return view('admin_panel.users.orders.orders_detail', ['order' => $order, 'user' => $user]);
    }
}
