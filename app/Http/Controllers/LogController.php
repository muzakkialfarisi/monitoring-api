<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\MainDealerRepository;
use App\Repositories\LogRepository;

use App\Transformers\Transformer;
use App\Transformers\LogTransformer;

class LogController extends Controller
{
    public function index(Int $main_dealer_id = null)
    {
        $data = (new MainDealerRepository())
                ->set_id($main_dealer_id ?? 0)
                ->getFirst();
                
        if(!isset($main_dealer_id)){
            $data['log'] = (new LogRepository())
                ->getList();
        }
        else
        {
            $data['log'] = (new LogRepository())
                ->set_main_dealer_id($main_dealer_id ?? 0)
                ->getList();
        }

        return view('log/index')->with(['data' => $data]);
    }
}