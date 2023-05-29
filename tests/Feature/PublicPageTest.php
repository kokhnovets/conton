<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    Тестирование отображения страниц для неавторизованных лиц:
    public function test_page_index()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_page_about()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }
    public function test_page_terms()
    {
        $response = $this->get('/terms');

        $response->assertStatus(200);
    }
    public function test_page_policy()
    {
        $response = $this->get('/policy');

        $response->assertStatus(200);
    }
    public function test_page_feedback()
    {
        $response = $this->get('/feedback');

        $response->assertStatus(200);
    }
    public function test_page_news()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);
    }
}
