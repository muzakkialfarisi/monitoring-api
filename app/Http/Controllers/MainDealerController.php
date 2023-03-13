<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MainDealerRepository;

class MainDealerController extends Controller
{
    public function index()
    {
        $data = (new MainDealerRepository())
                ->set_relationship(['backend'])
                ->getList();

        return view('maindealer/index')->with(['data' => $data]);
    }
}
