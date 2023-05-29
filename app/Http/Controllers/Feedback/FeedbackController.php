<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Mail\Feedback\FeedbackEmail;
use App\Models\Feedback;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index() {
        return view('feedback');
    }
    public function store(StoreFeedbackRequest $request) {
        $validated = $request->validated();
        $validated['status'] = 'Заявка принята.';
        Feedback::create($validated);
        Mail::to($validated['email'])->send(new FeedbackEmail());
        return redirect()->back()->with('message', 'Ваша заявка успешно отправлено, ожидайте обратной связи!');;
    }
}
