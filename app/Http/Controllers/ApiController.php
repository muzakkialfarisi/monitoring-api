<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\MainDealerRepository;
use App\Repositories\ApiRepository;
use App\Repositories\BackEndRepository;
use App\Repositories\FeatureRepository;

class ApiController extends Controller
{
    public function index(Int $main_dealer_id)
    {
        $data = (new MainDealerRepository())
                ->set_id($main_dealer_id ?? 0)
                ->getFirst();

        $data['api'] = (new ApiRepository())
                ->set_main_dealer_id($main_dealer_id ?? 0)
                ->getList();

        return view('api/index')->with(['data' => $data]);
    }

    public function upsert($main_dealer_id = null, $id = null)
    {
        $data = (new MainDealerRepository())
                ->set_id($main_dealer_id ?? 0)
                ->getFirst();

        $data['api'] = (new ApiRepository())
                ->set_relationship(['headers', 'body'])
                ->set_id($id ?? 0)
                ->getFirst();

        $data['back_end'] = (new BackEndRepository())
                ->set_main_dealer_id($main_dealer_id ?? 0)
                ->getList();
        
        $data['feature'] = (new FeatureRepository())
                ->getList();
                
        return view('api/upsert')->with(['data' => $data]);
    }

    public function upsert_process(Request $request, $main_dealer_id = null, $id = null)
    {
        $data = (new MainDealerRepository())
                ->set_id($main_dealer_id ?? 0)
                ->getFirst();

        $data['api'] = (new ApiRepository())
                ->set_id($id ?? 0)
                ->getFirst();

        $data['backend'] = (new BackEndRepository())
                ->set_main_dealer_id($main_dealer_id ?? 0)
                ->getList();

        $data['feature'] = (new FeatureRepository())
                ->getList();
                
        return view('api/upsert')->with(['data' => $data]);
    }
}
