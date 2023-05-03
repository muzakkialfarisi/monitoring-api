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
        $params['conditions'][] = [
            'field' => 'id',
            'value' => $main_dealer_id,
        ];

        $params['relationship'] = ['api'];

        $data = (new MainDealerRepository())->get_first($params);

        return view('api/index')->with(['data' => $data]);
    }

    public function upsert($main_dealer_id = null, $id = null)
    {
        $params['relationship'] = ['main_dealer', 'back_end'];

        $data = (new ApiRepository())
            ->get_first($params);

        $params_b['conditions'][] = [
            'field' => 'main_dealer_id',
            'value' => $main_dealer_id,
        ];
        $data['back_ends'] = (new BackEndRepository())
            ->get_list($params_b);

        $params_f['conditions'][] = [
            'field' => 'is_active',
            'value' => 1,
        ];
        $data['features'] = (new FeatureRepository())
            ->get_list($params_f);

        $data['main_dealer']['id'] = $main_dealer_id ?? 0;

        return view('api/upsert')->with(['data' => $data]);
    }

    public function upsert_process(Request $request, $main_dealer_id = null, $id = null)
    {
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new ApiValidator())->validate($params);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        if ($id == null) {
            $save = (new ApiRepository())
                ->save_record($params);
        } else {
            $save = (new ApiRepository())
                ->update_record_by_id($params['id'], $params);
        }

        if (!$save) {
            return redirect()->back()
                ->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('api.upsert', ['main_dealer_id' => $main_dealer_id, 'id' => $params['id']])
            ->with(['success' => 'Data saved successfully!']);
    }

    public function delete_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        $data = (new ApiRepository())
            ->delete_record_by_id($params['id']);

        if (!$data) {
            return redirect()->back()->with(['error' => 'Delete faied!']);
        }

        return view('api.index', ['main_dealer_id' => $params['main_dealer_id']])->with(['success' => 'Deleted successfully!']);
    }

    public function alert()
    {
        $data['api'] = (new ApiRepository())
            ->get_list_error();

        return view('api/alert')->with(['data' => $data]);
    }

    public function detail(Int $main_dealer_id, Int $id)
    {
        $params['conditions'] = [
            [
                'field' => 'id',
                'value' => $id,
            ],
            [
                'field' => 'main_dealer_id',
                'value' => $main_dealer_id,
            ]
        ];

        $params['relationship'] = ['main_dealer', 'feature', 'back_end', 'status_code_log', 'response_time_log', 'response_body_log'];

        $data['api'] = (new ApiRepository())
            ->get_first();

        return view('api/detail')->with(['data' => $data]);
    }
}
