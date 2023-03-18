<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MainDealerValidator
{
  public function rules($id = null)
  {
    if(isset($id)){
        $validate['id'] = 'required|numeric|exists:main_dealer,id';
    }
    
    $validate['name'] = 'required|unique:main_dealer,name';
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
    return Validator::make($params, $this->rules($params['id'] ?? null), $this->message());
  }
}
