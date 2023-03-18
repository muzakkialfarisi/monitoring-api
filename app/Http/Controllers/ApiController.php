<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\MainDealerRepository;
use App\Repositories\ApiRepository;
use App\Repositories\BackEndRepository;
use App\Repositories\FeatureRepository;
use App\Validators\ApiValidator;

class ApiController extends Controller
{
    public function index($main_dealer_id = null)
    {
        $data = (new MainDealerRepository())
            ->set_relationship(['api'])
            ->set_id($main_dealer_id ?? 0)
            ->getFirst();

        return view('api/index')->with(['data' => $data]);
    }

    public function upsert($main_dealer_id = null, $id = null)
    {
        $data = (new MainDealerRepository())
            ->set_id($main_dealer_id ?? 0)
            ->getFirst();

        $data['api'] = (new ApiRepository())
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
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new ApiValidator())->validate($params);

        if ($validator->failed()) {
            return $validator->errors()->all();
        }

        if($id == null){
            $save = (new ApiRepository())->create($params);
        }
        else{
            $save = (new ApiRepository())
            ->set_id($params['id'])
            ->update($params);
        }

        if(!$save){
        }
                
        return redirect()->route('api.upsert', ['main_dealer_id' => $main_dealer_id, 'id' => $params['id']]);
    }

    public function delete_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        $data = (new ApiRepository())
                ->set_main_dealer_id($params['main_dealer_id'] ?? 0)
                ->set_id($params['id'] ?? 0)
                ->delete();
        
        if(!$data){
            return redirect()->back()->with(['error' => 'Delete faied!']);
        }

        return view('api.index', ['main_dealer_id' => $params['main_dealer_id']])->with(['success' => 'Deleted successfully!']);
    }
    
    public function alert(Int $main_dealer_id = null)
    {
        $data['api'] = (new ApiRepository())
            ->getListIsError();
        
        return view('api/alert')->with(['data' => $data]);
    }

    public function detail(Int $main_dealer_id, Int $id)
    {
        $data['api'] = (new ApiRepository())
            ->set_id($id)
            ->set_main_dealer_id($main_dealer_id)
            ->set_relationship(['main_dealer', 'feature', 'back_end', 'status_code_log', 'response_time_log', 'response_body_log'])
            ->getFirst();   

        return view('api/detail')->with(['data' => $data]);
    }
}
