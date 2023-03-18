<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BackEndValidator
{
  public function rules($params)
  {
    $validate['main_dealer_id'] = 'required|exists:main_dealer,id';
    $validate['name'] = 'required';
    $validate['base_url'] = 'required|unique:back_end,base_url,'.$params['base_url'].',base_url';
    $validate['is_active'] = 'required|numeric|in:0,1';

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
