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
        $params = json_decode(json_encode($request->all()), true);

        if(isset($params['username']) || isset($params['password'])){
            if($params['username'] == 'mzkalfarisi' && $params['password'] == 'innovation'){
                return redirect()->route('dashboard.index');
            }
        }
        
        return redirect()->route('login')->with(['error' => 'Username or Password incorrect!']);
    }

    public function logout()
    {
        return redirect()->route('login');
    }
}
