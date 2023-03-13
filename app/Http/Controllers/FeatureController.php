<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FeatureRepository;

class FeatureController extends Controller
{
    public function index()
    {
        $data = (new FeatureRepository())
                ->getList();

        return view('feature/index')->with(['data' => $data]);
    }
}
