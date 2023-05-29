<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ShowDetailController extends Controller
{
    public function index(Order $order) {
//        Детали объявления
        return view('admin_panel.users.orders.orders_detail', ['order' => $order]);
    }
    public function destroy(Order $order) {
//        Удаление объявления
        $order->delete();
        return redirect()->route('admin.orders')->with('message', 'Заказ успешно удален.');;
    }
}
