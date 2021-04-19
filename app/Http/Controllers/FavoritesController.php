<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function get(Request $request)
    {
        $param = Favorite::where('user_id', $request->user_id)
            ->select('favorite_id', 'user_id', 'store_id')
            ->get();
        return response()->json([
            'message' => 'Favorite got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        $now = Carbon::now();
        $items = [
            'user_id' => $request->user_id,
            'store_id' => $request->store_id,
            'created_at' => $now,
            'updated_at' => $now
        ];
        Favorite::insert($items);
        $param = Favorite::where('user_id', $request->user_id)
            ->where('store_id', $request->store_id)
            ->first();
        return response()->json([
            'message' => 'Favorite created successfully',
            'data' => $param
        ], 200);
    }

    public function delete(Request $request)
    {
        Favorite::where('favorite_id', $request->favorite_id)->delete();
        return response()->json([
            'message' => 'Favorite deleted successfully',
        ], 200);
    }
    
}
