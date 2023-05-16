<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BackEndValidator
{
  public function validate($params)
  {
    $validate['main_dealer_id'] = 'required|exists:main_dealer,id';
    $validate['name'] = 'required';
    $validate['base_url'] = 'required|unique:back_end,base_url';
    $validate['is_active'] = 'required|numeric|in:0,1';

    if (isset($params['id'])) {
      $validate['id'] = 'required|numeric|exists:back_end,id';
      $validate['base_url'] = 'required|unique:back_end,base_url,' . $params['base_url'] . ',base_url';
    }
    return Validator::make($params, $validate);
  }
}
