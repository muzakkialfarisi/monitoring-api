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

        if (isset($params['username']) || isset($params['password'])) {
            $query['conditions'] = [
                [
                    'field' => 'username',
                    'value' => $params['username']
                ],
            ];

            $user = (new UserRepository())->get_first($query);

            if ($user) {
                $password_validation = (new AuthRepository())->hash_check($params['password'] . $user['salt'], $user['password']);

                if ($password_validation) {
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
