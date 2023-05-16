<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Repositories\MainDealerRepository;
use App\Validators\MainDealerValidator;

class MainDealerController extends Controller
{
    public function index()
    {
        $query['order_field'] = 'id';
        $query['order_sort']  = 'asc';

        $data = (new MainDealerRepository())->get_list($query);

        return view('maindealer/index')->with(['data' => $data]);
    }

    public function upsert_process(Request $request)
    {
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new MainDealerValidator())->validate($params);

        if ($validator->fails()) {
            return redirect()->route('maindealer.index')->with(['error' => $validator->errors()->first()]);
        }

        if (isset($params['id'])) {
            $data = (new MainDealerRepository())
                ->update_record_by_id($params['id'], $params);
        } else {
            $data = (new MainDealerRepository())
                ->save_record($params);
        }

        if (!$data) {
            return redirect()->route('maindealer.index')->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('maindealer.index')->with(['success' => 'Data saved successfully!']);
    }
}
