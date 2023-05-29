<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnauthorizedTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    Попытка неавторизованного пользователя зайти в раздел настроек личного кабинета
    public function test_redirect_for_unauthorized_users_page_settings()
    {
        $response = $this->get('/account/settings');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_profile()
    {
        $response = $this->get('/account/settings/profile');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_details()
    {
        $response = $this->get('/account/settings/details');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_phone()
    {
        $response = $this->get('/account/settings/phone');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_order()
    {
        $response = $this->get('/order');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_travel()
    {
        $response = $this->get('/travel');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_orders()
    {
        $response = $this->get('/user/orders');

        $response->assertFound();
    }
    public function test_redirect_for_unauthorized_users_page_trips()
    {
        $response = $this->get('/user/trips');

        $response->assertFound();
    }
}
