<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MainDealerRepository;
use App\Repositories\BackEndRepository;
use App\Validators\BackEndValidator;

class BackEndController extends Controller
{
    public function index($main_dealer_id = null)
    {
        $data = (new MainDealerRepository())
            ->set_id($main_dealer_id ?? 0)
            ->set_relationship(['backend'])
            ->getFirst();

        if(!$data){
            return redirect()->back()->with(['error' => 'Main Dealer not found!']);
        }

        return view('backend/index')->with(['data' => $data]);
    }

    public function upsert_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        if (!isset($params['main_dealer_id'])) {
            return redirect()->route('maindealer.index')->with(['error' => 'Main Dealer not found!']);
        }
        
        $validator = (new BackEndValidator())->validate($params);

        if ($validator->fails()) {
            return redirect()->route('application.index', ['main_dealer_id' => $params['main_dealer_id']])
            ->with(['error' => $validator->errors()->first()]);
        }
        if(isset($params['id'])){
            $data = (new BackEndRepository())
                ->set_id($params['id'])
                ->set_data($params)
                ->update();
        }
        else{
            $data = (new BackEndRepository())
                ->set_data($params)
                ->create();
        }

        if(!$data){
            return redirect()->route('application.index', ['main_dealer_id' => $params['main_dealer_id']])
            ->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('application.index', ['main_dealer_id' => $params['main_dealer_id']])
        ->with(['success' => 'Data saved successfully!']);
    }
}
