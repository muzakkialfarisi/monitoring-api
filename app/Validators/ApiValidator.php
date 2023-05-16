<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ApiValidator
{
  public function validate($params)
  {
    $validate['feature_id'] = 'required|numeric|exists:feature,id';
    $validate['method'] = 'required|in:GET,POST,UPDATE,DELETE';
    $validate['back_end_id'] = 'required|numeric|exists:back_end,id';
    $validate['path'] = 'required';
    $validate['response_time_tolerance'] = 'numeric|min:0';
    $validate['priority'] = 'required|numeric|in,1,2,3,4';
    $validate['is_check_status_code'] = 'required|numeric|in,0,1';
    $validate['is_check_response_time'] = 'required|numeric|in,0,1';
    $validate['is_check_response_body'] = 'required|numeric|in,0,1';

    if (isset($params['id'])) {
      $validate['id'] = 'required|numeric|exists:api,id';
    }

    return Validator::make($params, $validate);
  }
}
