<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteOrderController extends Controller
{
    public function destroyOrder(Order $order) {
        $order->delivery()->delete();
        $order->offers()->delete();
        Storage::deleteDirectory(preg_replace('/\/[^\/]+$/', '', $order->images()->first()->url));
        $order->images()->delete();
        $order->delete();
        return redirect()->route('user.orders')->with('message', 'Заказ успешно удалён.');
    }
}
