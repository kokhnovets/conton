<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function showAllNews() {
        return view('news.news', ['news' => News::where('deleted_at', null)->latest()->paginate(10)]);
    }
    public function showDetailNews(News $news) {
        return view('news.detail', compact('news'));
    }
}
