<?php

namespace App\Http\Controllers\PolicyAndTerms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowPolicyOrTermsController extends Controller
{
    public function showPolicy() {
        return view('policy');
    }
    public function showTerms() {
        return view('terms');
    }
}
