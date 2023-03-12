<?php

namespace App\Transformers;

use League\Fractal;

use App\Models\LogModel;

class LogTransformer extends Fractal\TransformerAbstract
{
    public function transform(LogModel $model)
    {
        $data = [
            'id' => (int) $model->id,
            'main_dealer_id' => (int) $model->main_dealer_id,
            'main_dealer_name' => $model->main_dealer->name ?? $model->main_dealer_name,
            'feature_id' => (int) $model->feature_id,
            'feature_name' => $model->feature_name,
            'api_id' => (int) $model->api_id,
            'url' => $model->url,
            'request_header' => $model->request_header,
            'request_payload' => $model->request_payload,
            'status_code_factual' => (int) $model->status_code_factual,
            'status_code_actual' => (int) $model->status_code_actual,
            'status_code_validation' => $model->status_code_validation,
            'response_body_factual' => $model->response_body_factual,
            'response_body_actual' => $model->response_body_actual,
            'response_body_validation' => $model->response_body_validation,
            'response_time' => $model->response_time,
            'response_time_accumulation' => $model->response_time_accumulation,
            'response_time_validation' => $model->response_time_validation,
        ];
        
        return $data;
    }
}
