<?php

namespace App\Http\Controllers\Admin\Users\Ban;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banned\BannedRequest;
use App\Mail\User\Ban\BannedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BanController extends Controller
{
    // Блокировка пользователя
    public function banned(User $user, BannedRequest $request) {
        $validated = $request->validated(); // Валидация (проверка данных)
        if ($validated) { // Если валидация прошла успешно
            $user->ban([
                'comment' => $validated['reason_for_ban'], // Причина блокировка
                'expired_at' => $validated['ban_date'] ?? null // Если даты нет, то бан перманентный
            ]);
            Mail::to($user)->send(new BannedMail($user)); // Отправка пользователю уведомление о том, что его аккаунт заблокирован
            return response()->json(["status" => true]); // Статус
        } else {
            return response()->json([
                'error' => $validated->errors() // Отправка ошибки администратору через JSON
            ], 422);
        }
    }
}
