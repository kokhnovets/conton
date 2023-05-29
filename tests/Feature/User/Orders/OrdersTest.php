<?php

namespace Tests\Feature\User\Orders;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    // Маршрут страницы авторизации
    protected function loginPostRoute()
    {
        return route('login');
    }
    // Маршрут страницы пользовательских заказов
    protected function showUserOrdersGetRoute()
    {
        return route('order.add');
    }
    // Маршрут страницы пользовательских доставок
    protected function showUserTripsGetRoute()
    {
        return route('order.validate.show');
    }
    // Генерация пользователя
    protected function generateAndAuthorizedUser() {
        $user = User::factory()->create([
            'password' => Hash::make($password = '123!Asdf1'),
        ]);

        $this->post($this->loginPostRoute(), [
            'email' => $user->email,
            'password' => $password,
        ]);
        return $user;
    }
}
