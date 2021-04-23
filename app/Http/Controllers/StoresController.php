<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index(Request $request)
    {
        $param = Store::select('id', 'store_name', 'area_id', 'genre_id', 'image_url')->get();
        foreach($param as $item){
            $item['area_name'] = $item->area()->value('area_name');
            $item['genre_name'] = $item->genre()->value('genre_name');
            $item['user_favorite'] = $item->users()->where('user_id', $request->user_id)->exists();
        }
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $param = Store::find($id);
        $param['area_name'] = $param->area()->value('area_name');
        $param['genre_name'] = $param->genre()->value('genre_name');
        $param['user_favorite'] = $param->users()->where('user_id', $request->user_id)->exists();
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

}
