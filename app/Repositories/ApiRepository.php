<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\ApiModel;

class ApiRepository extends MasterRepository
{    
    public $model;

    public function __construct()
    {
        $this->model = new ApiModel();
        parent::__construct($this->model);
    }

    public function get_list_error()
    {
        $data = (new ApiModel())->where('is_active', 1)
            ->whereNull('deleted_at')
            ->where('status_code_validation', 0)
            ->orWhere('response_time_validation', 0)
            ->orWhere('response_body_validation', 0)
            ->orderBy('priority')
            ->with(['main_dealer']);

        return (object) [
            "total" => $data->count(),
            "rows" =>  $data->get()
        ];
    }

    public function update_record_by_id($id, $params)
    {
        $data = $this->set_data($params);

        return parent::update_record_by_id($id, $data);
    }

    public function save_record($params)
    {
        $data = $this->set_data($params);

        return parent::save_record($data);
    }

    private function set_data($param)
    {
        $data = [
            'back_end_id' => $param['back_end_id'] ?? null,
            'main_dealer_id' => $param['main_dealer_id'] ?? null,
            'feature_id' => $param['feature_id'] ?? null,
            'path' => $param['path'] ?? null,
            'is_active' => $param['is_active'] ?? 0,
            'method' => $param['method'] ?? null,
            'main_dealer_id' => $param['main_dealer_id'] ?? null,
            'headers' => $param['headers'] ?? null,
            'params' => $param['params'] ?? null,
            'body' => $param['body'] ?? null,
            'status_code_validation' => $param['status_code_validation'] ?? 1,
            'response_time_validation' => $param['response_time_validation'] ?? 1,
            'response_body_validation' => $param['response_body_validation'] ?? 1,
            'headers' => $param['headers'] ?? null,
            'body' => $param['body'] ?? null,
            'params' => $param['params'] ?? null,
            'status_code_actual' => $param['status_code_actual'] ?? null,
            'response_time_actual' => $param['response_time_actual'] ?? null,
            'response_body_actual' => $param['response_body_actual'] ?? null,
            'response_time_tolerance' => $param['response_time_tolerance'] ?? null,
            'is_push_email' => $param['is_push_email'] ?? null,
            'is_check_status_code' => $param['is_check_status_code'] ?? null,
            'is_check_response_body' => $param['is_check_response_body'] ?? null,
            'is_check_response_time' => $param['is_check_response_time'] ?? null,
            'priority' => $param['priority'] ?? 0,
            'status_code_id' => 0,
            'response_time_id' => 0,
            'response_body_id'=> 0,
        ];

        return $data;
    }
}