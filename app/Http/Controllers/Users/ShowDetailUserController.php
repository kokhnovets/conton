<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowDetailUserController extends Controller
{
//    Просмотр детали о пользователе
    public function __invoke(User $user)
    {
        return view('users.show_user', ['user' => $user]);
    }
}
