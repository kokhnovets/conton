<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
//    Добавление новости
    public function store(StoreNewsRequest $request) {
        $validated = $request->validated();
        $path = '';
        if ($request->hasFile('preview')) {
            $path = $request->file('preview')->store('news/previews');
        }
        $validated['preview'] = $path;
        $news = Auth::user()->news()->create($validated);
        return redirect()->route('news.show', $news->id);
    }
}
