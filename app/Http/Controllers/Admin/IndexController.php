<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $allOrders = Order::all()->count();
        $sussesOrders = Order::where('order_status', 2)->count();
        $deliveryOrders = Order::where('order_status', 1)->count();
        return view('admin_panel.admin_panel', ['allOrders' => $allOrders, 'sussesOrders' => $sussesOrders, 'deliveryOrders' => $deliveryOrders]);
    }
}
