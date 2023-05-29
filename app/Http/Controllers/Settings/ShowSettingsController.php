<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ShowSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Показать настройки
    public function showSettings() {
        return view('lk_settings.profile', ['user' => auth()->user()]);
    }
    // Показать настройки личной информации
    public function showSettingsProfile() {
        return $this->showSettings();
    }
    // Показать настройки с деталями аккаунта
    public function showSettingsDetails() {
        // Идентификатор авторизованного пользователя
        $userId = auth()->id();
        // Поиск в базе данных пользователя с идентификатором
        $user = User::findOrFail($userId);
        // Проверка на наличие активных заказов и доставок
        $ordersExists = $user->orders()->where('order_status', 1)->exists();
        $deliveryExists = $user->delivery()->where('order_is_completed', 0)->exists();
        // Отображение страницы
        return view('lk_settings.details', [
            'user' => auth()->user(),
            'orderExists' => $ordersExists,
            'deliveryExists' => $deliveryExists
        ]);
    }
    // Показать настройки телефона
    public function showSettingsPhone() {
        return view('lk_settings.phone', ['user' => auth()->user()]);
    }
}
