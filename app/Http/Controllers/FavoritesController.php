<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function post(Request $request)
    {
        $param = Favorite::create([
            'user_id' => $request->user_id,
            'store_id' => $request->store_id,
        ]);
        return response()->json([
            'message' => 'Favorite created successfully',
            'data' => $param
        ], 201);
    }

    public function delete(Request $request)
    {
        Favorite::where('store_id', $request->store_id)
            ->where('user_id', $request->user_id)
            ->delete();
        return response()->json([
            'message' => 'Favorite deleted successfully',
        ], 200);
    }
    
}
