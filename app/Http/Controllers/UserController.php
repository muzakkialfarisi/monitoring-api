<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserController extends Controller
{
    public function index()
    {
        $data = (new UserRepository())->get_list();

        return view('user/index')->with(['data' => $data]);
    }

    public function upsert($id = null)
    {
        if (isset($id)) {
            $query['conditions'] = [
                [
                    'field' => 'id',
                    'value' => $id
                ]
            ];

            $data = (new UserRepository())->get_first($query);

            if (!$data) {
                return redirect()->back()
                    ->with(['error' => 'Data not found!']);
            }
        }

        return view('user.upsert', ['id' => $id]);
    }

    public function upsert_process(Request $request, $id = null)
    {
        $params = json_decode(json_encode($request->all()), true);

        $validator = (new UserValidator())->registration($params);

        if ($validator->fails()) {
            return redirect()->back()
                ->with(['error' => $validator->errors()->first()]);
        }

        if ($id == null) {
            $save = (new UserRepository())
                ->save_record($params);
        } else {
            $query['conditions'] = [
                [
                    'field' => 'id',
                    'value' => $id
                ]
            ];

            $user = (new UserRepository())
                ->get_first($query);

            if (!$user) {
                return redirect()->back()
                    ->with(['error' => 'DUser not found!']);
            }

            $save = (new UserRepository())
                ->update_record_by_id($user['id'], $params);
        }

        if (!$save) {
            return redirect()->back()
                ->with(['error' => 'Data failed to save!']);
        }

        return redirect()->route('user.upsert', ['id' => $user['id']])
            ->with(['success' => 'Data saved successfully!']);
    }
}
