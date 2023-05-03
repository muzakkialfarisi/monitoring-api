<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public function registration($params)
    {
        $validate['name']       = 'required';
        $validate['username']   = 'required|unique:users,username';
        $validate['email']      = 'required|email|unique:users,email';

        return Validator::make($params, $validate);
    }

}
