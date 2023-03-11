<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

use App\Services\ApiService;

class WandaApp extends Command
{
    protected $signature = 'wanda:app';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
        $this->api_service = new ApiService();
    }

    public function handle()
    {
        $data = $this->api_service
            ->set_main_dealer_id(1)
            ->set_back_end_name('app')
            ->getApi();

        $request_time = new self();

        foreach($data->rows as $item){
            
            try{
                $data = $this->client->get(
                    $item['url'], [
                    'headers' => $item['headers'],
                    'query' =>  json_encode($item['params']),
                    'body' =>  json_encode($item['body']),
                    'on_stats' => function (TransferStats $stats) use ($request_time)  {
                        $stats->getTransferTime();
                        $request_time->setTotaltime($stats->getTransferTime());
                    }
                ]);
            }
            catch(ClientErrorResponseException $e){
                return false;
            }

            if(isset($data)){
                
            }
    
            $this->info('response time = ' . $request_time->getTotaltime());
            $this->info('data = ' . 'as');
            dd(json_decode($data->getBody()));
        }
        
    }

    private function getTotaltime()
    {
        return $this->totaltime;
    }

    private function setTotaltime($time)
    {
        $this->totaltime = $time;
    }
}
