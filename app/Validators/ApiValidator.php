<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ApiValidator
{
  public function rules($id = null)
  {
    if(isset($id)){
        $validate['id'] = 'required|numeric|exists,api,id';
    }
    
    $validate['feature_id'] = 'required|numeric|exists,feature,id';
    $validate['method'] = 'required|in,GET,POST,UPDATE,DELETE';
    $validate['back_end_id'] = 'required|numeric|exists,back_end,id';
    $validate['path'] = 'required';
    $validate['headers'] = '';
    $validate['body'] = '';
    $validate['status_code_actual'] = '';
    $validate['response_time_actual'] = 'numeric|min:0|';
    $validate['response_time_tolerance'] = 'numeric|min:0|';
    $validate['response_body_actual'] = '';
    $validate['priority'] = 'required|numeric|in,1,2,3,4';
    $validate['is_check_status_code'] = 'required|numeric|in,0,1';
    $validate['is_check_response_time'] = 'required|numeric|in,0,1';
    $validate['is_check_response_body'] = 'required|numeric|in,0,1';

    return $validate;
  }

  public function message()
  {
    return [
      'required' => ':attribute harus diisi',
      'numeric' => ':attribute harus numeric',
      'exists' => ':attribute harus terdaftar',
      'min' => ':attribute tidak boleh kurang dari min:',
      'in' => ':attribute tidak terdaftar',
    ];
  }

  public function validate($params)
  {
    return Validator::make($params, $this->rules($params['id']), $this->message());
  }
}
