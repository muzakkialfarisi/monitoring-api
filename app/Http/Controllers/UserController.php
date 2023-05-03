<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function index()
    {
        $data = (new UserRepository())->get_list();

        return view('user/index')->with(['data' => $data]);
    }
}
