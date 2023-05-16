<?php

namespace App\Validators;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MainDealerValidator
{
  public function validate($params)
  {
    $validate['is_active'] = 'required|numeric|in:0,1';
    $validate['name'] = 'required|unique:main_dealer,name';

    if (isset($params['id'])) {
      $validate['id'] = 'required|numeric|exists:main_dealer,id';
      $validate['name'] = 'required|unique:main_dealer,name,' . $params['name'] . ',name';
    }

    return Validator::make($params, $validate);
  }
}
