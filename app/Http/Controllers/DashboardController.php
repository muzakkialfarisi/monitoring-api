<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MainDealerRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\ApiRepository;
use App\Repositories\LogRepository;

class DashboardController extends Controller
{
    public function index()
    {
        $main_dealer = (new MainDealerRepository())
            ->count_list();

        $feature = (new FeatureRepository())
            ->count_list();

        $api = (new ApiRepository())
            ->count_list();

        $log = (new LogRepository())
            ->getFailur();

        return view('dashboard/index')->with([
            'main_dealer' => $main_dealer,
            'feature' => $feature,
            'api' => $api,
            'log' => $log,
        ]);
    }
}
