<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LogRepository;

use App\Transformers\Transformer;
use App\Transformers\LogTransformer;

class LogController extends Controller
{
    public function wanda()
    {
        $data = (new LogRepository())
            ->set_main_dealer_id(1)
            ->getList();

        $data->rows = (new Transformer())->buildCollection($data->rows, new LogTransformer);
        // dd($data);
        return view('log/wanda')->with(['data' => $data]);
    }
}
