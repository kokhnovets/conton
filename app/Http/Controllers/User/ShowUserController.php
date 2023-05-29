<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Вывод всех размещенных заказов авторизованного пользователя:
    public function showUserOrders()
    {
        return view('user.orders.posted', [
            'orders' => auth()->user()->orders()->where('order_status', 0)->latest()->paginate(10),
            'count' => auth()->user()->orders()->where('order_status', 0)->count()]);
    }
    // Вывод всех размещенных заказов
    public function showUserOrdersPosted()
    {
        return $this->showUserOrders();
    }
    // Вывод всех активных заказов
    public function showUserOrdersActive()
    {
        return view('user.orders.active', [
            'orders' => auth()->user()->orders()->where('order_status', 1)->latest()->paginate(10),
            'count' => auth()->user()->orders()->where('order_status', 1)->count()]);
    }
    // Вывод всех выполненных заказов
    public function showUserOrdersCompleted()
    {
        return view('user.orders.completed', [
            'orders' => auth()->user()->orders()->where('order_status', 2)->latest()->paginate(10),
            'count' => auth()->user()->orders()->where('order_status', 2)->count()]);
    }
    // Отображение активных заказов в разделе "Поездки":
    public function showUserTrips()
    {
        $orders = Order::join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->where('deliveries.user_id', auth()->id())->where('deliveries.deleted_at', null)
            ->where('deliveries.order_is_completed', 0)->select('orders.*')->latest()->paginate(15);
        $count = Order::join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->where('deliveries.user_id', auth()->id())->where('deliveries.deleted_at', null)
            ->where('deliveries.order_is_completed', 0)->select('orders.*')->count();
        return view('user.trips.active', ['orders' => $orders, 'count' => $count]);
    }
    // Отображение активных заказов в разделе "Поездки":
    public function showUserTripsActive()
    {
        return $this->showUserTrips();
    }
    // Отображение доставленных заказов в разделе "Поездки":
    public function showUserTripsCompleted()
    {
        $orders = Order::join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->where('deliveries.user_id', auth()->id())->where('deliveries.deleted_at', null)
            ->where('deliveries.order_is_completed', 1)->select('orders.*')->latest()->paginate(15);
        $count = Order::join('deliveries', 'orders.id', '=', 'deliveries.order_id')
            ->where('deliveries.user_id', auth()->id())->where('deliveries.deleted_at', null)
            ->where('deliveries.order_is_completed', 1)->select('orders.*')->count();
        return view('user.trips.completed', ['orders' => $orders, 'count' => $count]);
    }
    // Отображение заказа авторизованного пользователя:
    public function showUserOrderPosted(Order $order)
    {
        // Проверяет, относится ли заказ к определенному разделу
        $orderExists = $order->where('id', $order->id)
            ->where('user_id', auth()->id())
            ->where('deleted_at', null)
            ->where('order_status', 0);
        $statusExists = $order->statuses()->exists();
        // Если заказ относится к опр. разделу, то выводит представление
        if ($orderExists->exists()) {
            return view('user.orders.detail', ['order' => $order, 'statuses' => $statusExists]);
        }
        // А иначе возвращает пользователя обратно
        return redirect()->back();
    }
    public function showUserOrderActive(Order $order)
    {
        $orderExists = $order->where('id', $order->id)
            ->where('user_id', auth()->id())
            ->where('deleted_at', null)
            ->where('order_status', 1);
        $statusExists = $order->statuses()->exists();
        if ($orderExists->exists()) {
            return view('user.orders.detail', ['order' => $order, 'statuses' => $statusExists]);
        }
        return redirect()->back();
    }
    public function showUserOrderCompleted(Order $order)
    {
        $orderExists = $order->where('id', $order->id)
            ->where('user_id', auth()->id())
            ->where('deleted_at', null)
            ->where('order_status', 2);
        $statusExists = $order->statuses()->exists();
        if ($orderExists->exists()) {
            return view('user.orders.detail', ['order' => $order, 'statuses' => $statusExists]);
        }
        return redirect()->back();
    }
    // Отображение одного активного заказа в разделе "Поездки"
    public function showUserTripActive(Order $order)
    {
        $orderExists = $order->delivery()
            ->where('user_id', auth()->id())
            ->where('order_id', $order->id)
            ->where('deleted_at', null)
            ->where('order_is_completed', 0);
        if ($orderExists->exists()) {
            return view('user.trips.delivery', compact('order'));
        }
       return redirect()->back();
    }
    // Отображение одного выполненного заказа в разделе "Поездки"
    public function showUserTripCompleted(Order $order)
    {
        $orderExists = $order->delivery()
            ->where('user_id', auth()->id())
            ->where('order_id', $order->id)
            ->where('deleted_at', null)
            ->where('order_is_completed', 1);
        if ($orderExists->exists()) {
            return view('user.trips.delivery', compact('order'));
        }
        return redirect()->back();
    }
}
