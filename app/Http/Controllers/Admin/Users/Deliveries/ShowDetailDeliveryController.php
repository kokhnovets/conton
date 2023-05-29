<?php

namespace App\Http\Controllers\Admin\Users\Deliveries;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ShowDetailDeliveryController extends Controller
{
//    Просмотр детали доставки пользователя
    public function delivery(User $user, Order $order) {
        return view('admin_panel.users.deliveries.deliveries_detail', ['order' => $order, 'user' => $user]);
    }
}
