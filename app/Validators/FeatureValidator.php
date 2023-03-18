<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FeatureValidator
{
  public function rules($id = null)
  {
    if(isset($id)){
        $validate['id'] = 'required|numeric|exists:feature,id';
    }
    
    $validate['name'] = 'required';
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
