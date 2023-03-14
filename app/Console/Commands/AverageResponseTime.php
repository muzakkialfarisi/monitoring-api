<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ApiRepository;
use App\Repositories\LogRepository;

class AverageResponseTime extends Command
{
    protected $signature = 'avg:responsetime';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $apis = (new ApiRepository())
            ->getList();

        foreach($apis->rows as $api)
        {
            $average_log_time = (new LogRepository())
                    ->set_main_dealer_id($api->main_dealer_id)
                    ->set_api_id($api->id)
                    ->getAverageResponseTime();

            $api->response_time_actual =  $average_log_time;
            $api->save();
        }
    }
}