<?php

namespace App\Http\Controllers;
use App\Models\Manager;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function get(Request $request)
    {
        // $param = "";
        // if ($request->store_id == null) {
            $param = Manager::get_stores_name();
        // } else {
            // $param = Manager::get_store_manager($request);
        // }
        return response()->json([
            'message' => 'Manager got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        $check = auth()->user()->administrator;
        if (!$check) {
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }

        $param = Manager::post_manager($request);
        return response()->json([
            'message' => 'Manager created successfully',
            'data' => $param,
        ], 201);
    }

    // public function delete(Request $request)
    // {
    //     Manager::delete_manager($request);
    //     return response()->json([
    //         'message' => 'Manager deleted successfully',
    //     ], 200);
    // }
}
