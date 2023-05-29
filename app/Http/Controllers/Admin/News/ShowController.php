<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowController extends Controller
{
//    Открытие формы добавления новости
    public function index() {
        return view('admin_panel.news.add_news');
    }
}
