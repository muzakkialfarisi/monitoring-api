<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LogRepository;

use App\Transformers\Transformer;
use App\Transformers\LogTransformer;

class DashboardController extends Controller
{
    public function index()
    {
        $data = (new LogRepository())
            ->getList();

        $data->rows = (new Transformer())->buildCollection($data->rows, new LogTransformer);

        return view('dashboard/index')->with(['data' => $data]);
    }
}