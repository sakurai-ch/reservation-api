<?php

namespace App\Http\Controllers;

use App\Models\Area;

class AreasController extends Controller
{
    public function get()
    {
        // $param = Area::select('id', 'area_name')->get();
        $param = Area::get_areas();
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }
}
