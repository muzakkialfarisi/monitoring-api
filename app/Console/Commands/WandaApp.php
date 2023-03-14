<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\TransferStats;

use App\Services\ApiService;
use App\Services\LogService;

class WandaApp extends Command
{
    protected $signature = 'wanda:app';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
        $this->main_dealer_id = 1;
        $this->back_end_name = 'app';
        $this->client = new Client();
        $this->log_service = new LogService();
    }

    public function handle()
    {
        $api = (new ApiService())
            ->set_main_dealer_id($this->main_dealer_id)
            ->set_back_end_name($this->back_end_name)
            ->getApi();

        $log_service = $this->log_service;
        
        foreach($api->rows as $item){
            try{
                $data = $this->client->request(
                    $item['method'],
                    $item['url'], 
                    [
                        'headers' => $item['headers'],
                        'body' => json_encode($item['body']),
                        'on_stats' => function (TransferStats $stats) use ($log_service)  {
                            $log_service->set_response_time($stats->getTransferTime());
                        }
                    ]
                );

                $this->log_service->save_success([
                    'main_dealer_id' => $this->main_dealer_id,
                    'feature_id' => $item['feature_id'],
                    'feature_name' => $item['feature_name'],
                    'api_id' => $item['id'],
                    'url' => $item['url'],
                    'request_header' => json_encode($item['headers']),
                    'request_payload' => json_encode($item['body']),
                    'status_code_factual' => $data->getStatusCode(),
                    'response_body_factual' => $data->getBody()
                ], true);
            }
            catch(ConnectException $ex){
                $this->log_service->save_success([
                    'main_dealer_id' => $this->main_dealer_id,
                    'feature_id' => $item['feature_id'],
                    'feature_name' => $item['feature_name'],
                    'api_id' => $item['id'],
                    'url' => $item['url'],
                    'request_header' => json_encode($item['headers']),
                    'request_payload' => json_encode($item['body']),
                    'status_code_factual' => 651,
                    'response_body_factual' => '{"msg":"indicates that an attempt at a connection to the internet was unsuccessful, or an existing connection has been terminated."}'
                ], false);
            }
            catch(RequestException $ex){
                $this->log_service->save_success([
                    'main_dealer_id' => $this->main_dealer_id,
                    'feature_id' => $item['feature_id'],
                    'feature_name' => $item['feature_name'],
                    'api_id' => $item['id'],
                    'url' => $item['url'],
                    'request_header' => json_encode($item['headers']),
                    'request_payload' => json_encode($item['body']),
                    'status_code_factual' => 500,
                    'response_body_factual' => '{"msg":"Internal Server Error server error response code indicates that the server encountered an unexpected condition that prevented it from fulfilling the request."}'
                ], false);
            }
        }
    }
}