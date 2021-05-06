<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Favorite;

class FavoritesController extends Controller
{
    public function post(Request $request)
    {
        $param = Favorite::post_favorite($request);
        return response()->json([
            'message' => 'Favorite created successfully',
            // 'data' => $param
        ], 201);
    }

    public function delete(Request $request)
    {
        Favorite::delete_favorite($request);
        return response()->json([
            'message' => 'Favorite deleted successfully',
        ], 200);
    }
    
}
