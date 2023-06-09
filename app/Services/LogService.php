<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Libraries\Factory;

use App\Repositories\LogRepository;
use App\Repositories\ApiRepository;
use App\Mail\SendMail;

use App\Events\AfterAPIExecuted;

class LogService
{
    private float
        $response_time;

    public function __construct()
    {
        $this->log_repository = new LogRepository();
        $this->api_repository = new ApiRepository();
    }

    public function set_response_time(float $response_time)
    {
        $this->response_time = $response_time;
        return $this;
    }

    public function save_success(array $param, bool $is_success)
    {
        $api = $this->api_repository
                ->set_relationship(['main_dealer'])
                ->set_id($param["api_id"])
                ->getFirst();

        $api_is_update = false;
        $param["status_code_validation"] = true;
        $param["response_time_validation"] = true;
        $param["response_body_validation"] = true;

        if($api->is_check_status_code == true){
            if($param["status_code_factual"] <> $api->status_code_actual){
                $param["status_code_validation"] = false;
                if($api->status_code_validation == true){
                    $api_is_update = true;
                }
            }
        }

        if($api->is_check_response_time == true){
            if(($api->response_time_actual + $api->response_time_tolerance) < $this->response_time){
                $param["response_time_validation"] = false;
                if($api->response_time_validation == true){
                    $api_is_update = true;
                }
            }
        }

        if($api->is_check_response_body == true){
            if($api->response_body_actual <> $param["response_body_factual"]){
                $param["response_body_validation"] = false;
                if($api->response_body_validation == true)
                {
                    $api_is_update = true;
                }
            }
        }

        $log = $this->log_repository
            ->set_main_dealer_id($param["main_dealer_id"])
            ->set_main_dealer_name($api->main_dealer->name)
            ->set_feature_id($param["feature_id"])
            ->set_feature_name($param["feature_name"])
            ->set_api_id($param["api_id"])
            ->set_url($param["url"])
            ->set_request_header($param["request_header"])
            ->set_request_payload($param["request_payload"])
            ->set_status_code_factual($param["status_code_factual"])
            ->set_status_code_actual($api->status_code_actual)
            ->set_status_code_validation($param["status_code_validation"])
            ->set_response_body_factual($param["response_body_factual"])
            ->set_response_body_actual($api->response_body_actual ?? '{}')
            ->set_response_body_validation($param["response_body_validation"])
            ->set_response_time($this->response_time ?? 0)
            ->set_response_time_accumulation($api->response_time_actual)
            ->set_response_time_validation($param["response_time_validation"])
            ->save();

        if($api_is_update == true){
            if($param["status_code_validation"] == false){
                $api->status_code_validation = $param["status_code_validation"];
                $api->status_code_id = $log->id;
            }
            if($param["response_body_validation"] == false){
                $api->response_body_validation = $param["response_body_validation"];
                $api->response_body_id = $log->id;
            }
            if($param["response_time_validation"] == false){
                $api->response_time_validation = $param["response_time_validation"];
                $api->response_body_id = $log->id;
            }
            $api->save();

            if($api->is_push_email == true){
                event(new AfterAPIExecuted([
                    'telegram' => [
                        'chat_id' => config('tele.merapi_channel_id'),
                        'text' => $log
                    ]
                ]));

                \Mail::to('mzkalfarisi@gmail.com')
                    ->cc(['muzakki.ahmadalfarisi@hso.astra.co.id'])
                    ->send(new SendMail([
                        'title' => 'Alert for your API',
                        'data' => $log
                    ]));
            }
        }
    }
}