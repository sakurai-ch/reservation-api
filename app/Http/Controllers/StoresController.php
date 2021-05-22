<?php

namespace App\Http\Controllers;

use App\Models\Store;
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
