<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\MainDealerRepository;
use App\Repositories\ApiRepository;

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
}
