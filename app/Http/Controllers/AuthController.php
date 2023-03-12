<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function login_process(Request $request)
    {
        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        return redirect()->route('login');
    }
}
