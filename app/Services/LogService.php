<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Libraries\Factory;

use App\Repositories\LogRepository;

class LogService
{
    private float
        $response_time;

    public function __construct()
    {
        $this->log_repository = new LogRepository();
    }

    public function set_response_time(float $response_time)
    {
        $this->response_time = $response_time;
        return $this;
    }

    public function save_success(array $param, bool $is_success)
    {
        // dd($param);
        $response_time_accumulation = $this->log_repository
            ->set_main_dealer_id($param["main_dealer_id"])
            ->set_api_id($param["api_id"])
            ->get_response_time_accumulation();
        $status_code_validation = false;
        $status_code_actual = 200;
        $response_body_actual = '{"status":1}';
        $response_body_validation = false;
        $response_time_validation = false;
    
        // for initial hit
        $response_time_accumulation = $response_time_accumulation > 0.0 ? $response_time_accumulation : 0.5;

        if($is_success){
            if($param["status_code_factual"] >= 200 || $param["status_code_factual"] <= 299){
                $status_code_validation = true;
                $status_code_actual = $param["status_code_factual"];
            }
            
            if($this->response_time < ($response_time_accumulation + 10)){
                $response_time_validation = true;
            }
    
            // get response body use decode
            $response_body_factual = json_decode($param["response_body_factual"]);
    
            if($response_body_factual->status == 1)
            {
                $response_body_validation = true;
            }
        }
        
        $data = $this->log_repository
            ->set_main_dealer_id($param["main_dealer_id"])
            // ->set_main_dealer_name($param["main_dealer_name"])
            ->set_feature_id($param["feature_id"])
            ->set_feature_name($param["feature_name"])
            ->set_api_id($param["api_id"])
            ->set_url($param["url"])
            ->set_request_header($param["request_header"])
            ->set_request_payload($param["request_payload"])
            ->set_status_code_factual($param["status_code_factual"])
            ->set_status_code_actual($status_code_actual)
            ->set_status_code_validation($status_code_validation)
            ->set_response_body_factual($param["response_body_factual"])
            ->set_response_body_actual($response_body_actual)
            ->set_response_body_validation($response_body_validation)
            ->set_response_time($this->response_time ?? 0)
            ->set_response_time_accumulation($response_time_accumulation)
            ->set_response_time_validation($response_time_validation)
            ->save();
    }
}