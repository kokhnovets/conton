<?php

namespace App\Http\Controllers\Admin\Users\Restore;

use App\Http\Controllers\Controller;
use App\Mail\Status\StatusMail;
use App\Mail\User\Restore\RestoreMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RestoreController extends Controller
{
    public function restore(User $user) {
        $user->restore(); // Восстановление аккаунта
        Mail::to($user)->send(new RestoreMail($user)); // Отправка письма о восстановлении аккаунта
        return redirect()->back();
    }
}
