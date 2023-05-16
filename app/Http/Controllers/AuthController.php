<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function login_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        if (isset($params['email']) || isset($params['password'])) {
            $query['conditions'] = [
                [
                    'field' => 'email',
                    'value' => $params['email']
                ],
            ];

            $user = (new UserRepository())->get_first($query);

            if ($user) {
                $password_validation = (new AuthRepository())->hash_check($params['password'] . $user['salt'], $user['password']);
                if ($password_validation) {
                    $credential = [
                        'email'     => $user['email'],
                        'password'  => $user['password'],
                    ];

                    
                    return redirect()->intended('dashboard');

                    return redirect()->route('dashboard.index');
                }
            }
        }

        return redirect()->route('login')->with(['error' => 'Username or Password incorrect!']);
    }

    public function logout()
    {
        return redirect()->route('login');
    }
}
 