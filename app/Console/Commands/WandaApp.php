<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
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
        $this->api_service = new ApiService();
        $this->log_service = new LogService();
    }

    public function handle()
    {
        $api = $this->api_service
            ->set_main_dealer_id($this->main_dealer_id)
            ->set_back_end_name($this->back_end_name)
            ->getApi();

        $log_service = $this->log_service;

        foreach($api->rows as $item){
            try{
                $data = $this->client->get(
                    $item['url'], [
                    'headers' => $item['headers'],
                    'query' =>  json_encode($item['params']),
                    'body' =>  json_encode($item['body']),
                    'on_stats' => function (TransferStats $stats) use ($log_service)  {
                        $log_service->set_response_time($stats->getTransferTime());
                    }
                ]);
            }
            catch(ClientErrorResponseException $e){
                return 1;
            }

            if(isset($data)){
                if($data->getStatusCode() == 200){
                    $return = $this->log_service->save_success([
                        'main_dealer_id' => $this->main_dealer_id,
                        'feature_id' => $item['feature_id'],
                        'feature_name' => $item['feature_name'],
                        'api_id' => $item['id'],
                        'url' => $item['url'],
                        'request_header' => json_encode($item['headers']),
                        'request_payload' => json_encode($item['body']),
                        'status_code_factual' => $data->getStatusCode(),
                        'response_body_factual' => $data->getBody()
                    ]);
                }
                else{

                }
            }
    
            // $this->info('response time = ' . $request_time->getTotaltime());
            // $this->info('data = ' . $request_timea);
            // dd(json_decode($data->getBody()));
        }
        
    }
}