<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Libraries\Factory;
use App\Repositories\MainDealerRepository;
use App\Validators\MainDealerValidator;

class MainDealerController extends Controller
{
    public function index()
    {
        $data = (new MainDealerRepository())
                ->set_relationship(['backend'])
                ->getList();

        return view('maindealer/index')->with(['data' => $data]);
    }

    public function upsert_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new MainDealerValidator())->validate($params);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        if(isset($params['id'])){
            $data = (new MainDealerRepository())
                ->set_id($params['id'])
                ->set_data($params)
                ->update();
        }
        else{
            $data = (new MainDealerRepository())
                ->set_data($params)
                ->create();
        }

        if(!$data){
            return redirect()->route('maindealer.index');
        }

        return redirect()->route('maindealer.index');
    }
}
