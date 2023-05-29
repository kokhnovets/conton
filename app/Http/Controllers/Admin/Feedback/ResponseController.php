<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedbackRequest;
use App\Mail\ResponseMail;
use App\Models\Feedback;
use App\Models\ResponseFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResponseController extends Controller
{
//    Ответ пользователю из обратной связи
    public function index(FeedbackRequest $request, Feedback $feedback) {
        $validated = $request->validated();
        if ($validated) {
            ResponseFeedback::create([
               'feedback_id' => $feedback->id,
               'message' => $validated['message']
            ]);
            $feedback->fill([
                'status' => $validated['status']
            ]);
            $feedback->save();
            Mail::to($feedback->email)->send(new ResponseMail($validated['message'], $validated['status']));
            return response()->json(["status" => true]);
        } else {
            return response()->json([
                'error' => $validated->errors()
            ], 422);
        }
    }
}
