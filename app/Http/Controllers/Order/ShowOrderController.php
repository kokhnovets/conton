<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Открыть страницу добавления заказа
    public function showAddOrderForm() {
        return view('orders_crud.add_order');
    }

}
