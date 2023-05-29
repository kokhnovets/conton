<?php

namespace App\Http\Controllers\Admin\Users\Ban;

use App\Http\Controllers\Controller;
use App\Mail\User\Unban\UnbannedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UnbanController extends Controller
{
    // Разблокировка аккаунта пользователя
    public function unbanned(User $user) {
        $user->unban(); // Разблокировка пользователя
        Mail::to($user)->send(new UnbannedMail($user)); // Отправка письма о разблокировке пользователю
        return redirect()->back();
    }
}
