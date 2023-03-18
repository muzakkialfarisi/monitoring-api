<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MainDealerValidator
{
  public function rules($params)
  {
    $validate['is_active'] = 'required|numeric|in:0,1';
    $validate['name'] = 'required|unique:main_dealer,name';

    if(isset($params['id'])){
      $validate['id'] = 'required|numeric|exists:main_dealer,id';
      $validate['name'] = 'required|unique:main_dealer,name,'.$params['name'].',name';
    }
    
    return $validate;
  }

  public function message()
  {
    return [
      'required' => ':attribute harus diisi',
      'numeric' => ':attribute harus numeric',
      'exists' => ':attribute harus terdaftar',
      'unique' => ':attribute sudah terdaftar',
      'in' => ':attribute tidak terdaftar',
    ];
  }

  public function validate($params)
  {
    return Validator::make($params, $this->rules($params), $this->message());
  }
}
