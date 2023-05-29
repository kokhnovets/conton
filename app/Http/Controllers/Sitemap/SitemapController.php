<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Order;
use App\Models\User;

class SitemapController extends Controller
{
    // Генерация Sitemap.xml
    public function index() {
        $orders = News::where('deleted_at', null)->get(); // Вывод из БД всех новостей
        $news = Order::where('order_status', 0)->where('deleted_at', null)->get(); // Вывод из БД всех доступных заказов
        $users = User::where('deleted_at', null)->where('banned_at', null)->get(); // Вывод из БД всех доступных пользователей
        return response()->view('sitemap', [
            'orders' => $orders,
            'news' => $news,
            'users' => $users
        ])->header('Content-Type', 'text/xml');
    }
}
