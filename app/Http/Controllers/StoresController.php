<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Manager;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index(Request $request)
    {
        $param = Store::index_stores($request);
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $param = Store::show_store($request, $id);
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $check = manager::where('user_id', auth()->user()->id)
            ->where('store_id', $id)
            ->exists();
        if(!$check){
            return response()->json([
                'message' => 'unauthorized',
            ], 401);
        }

        $param = "";
        if($request->file != null){
            $param = Store::upload_storefile($request, $id);
        }else{
            $param = Store::update_storedata($request, $id);
        }
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

}
