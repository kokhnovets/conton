<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowAllUsersController extends Controller
{
//    Вывод всех пользователей, в том числе удаленных и заблокированных
    public function index() {
        return view('admin_panel.users.users', ['users' => User::with('bans')->withBanned()->withTrashed()->get()]);
    }
}
