<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ShowController extends Controller
{
//    Вывод всех заявок обратной связи пользователя
    public function index() {
        return view('admin_panel.feedbacks.feedbacks', ['feedbacks' => Feedback::all()]);
    }
}
