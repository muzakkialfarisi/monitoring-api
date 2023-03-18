<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FeatureRepository;
use App\Validators\FeatureValidator;

class FeatureController extends Controller
{
    public function index()
    {
        $data = (new FeatureRepository())
                ->getList();

        return view('feature/index')->with(['data' => $data]);
    }

    public function upsert_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new FeatureValidator())->validate($params);

        if ($validator->fails()) {
            return redirect()->route('feature.index')->with(['error' => $validator->errors()->first()]);
        }
        if(isset($params['id'])){
            $data = (new FeatureRepository())
                ->set_id($params['id'])
                ->set_data($params)
                ->update();
        }
        else{
            $data = (new FeatureRepository())
                ->set_data($params)
                ->create();
        }

        if(!$data){
            return redirect()->route('feature.index')->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('feature.index')->with(['success' => 'Data saved successfully!']);
    }
}
