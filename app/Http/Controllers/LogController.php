<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LogRepository;

use App\Transformers\Transformer;
use App\Transformers\LogTransformer;

class LogController extends Controller
{
    public function index(Int $id)
    {
        if(!isset($id)){
            $data = (new LogRepository())
                ->getList();
        }
        else
        {
            $data = (new LogRepository())
                ->set_main_dealer_id($id)
                ->getList();
        }

        $data->rows = (new Transformer())->buildCollection($data->rows, new LogTransformer);

        return view('log/index')->with(['data' => $data, 'main_dealer' => $this->get_main_dealer($id)]);
    }

    private function get_main_dealer(Int $id)
    {
        if($id == 1){
            return "Wahan Honda";
        }
        elseif($id == 2){
            return "MotorkuX";
        }
        elseif($id == 3){
            return "BromPit";
        }
        elseif($id == 4){
            return "Daya Auto";
        }
        else{
            return "To Be Announced";
        }
    }
}