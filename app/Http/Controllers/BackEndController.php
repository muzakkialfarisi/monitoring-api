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
        $query['conditions'][] = [
            'field' => 'id',
            'value' => $main_dealer_id,
        ];

        $query['relationship'] = ['backend'];

        $data = (new MainDealerRepository())->get_first($query);

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

        if (isset($params['id'])) {
            $data = (new BackEndRepository())
                ->update_record_by_id($params['id'], $params);
        } else {
            $data = (new BackEndRepository())
                ->save_record($params);
        }

        if (!$data) {
            return redirect()->route('application.index', ['main_dealer_id' => $params['main_dealer_id']])
                ->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('application.index', ['main_dealer_id' => $params['main_dealer_id']])
            ->with(['success' => 'Data saved successfully!']);
    }
}
