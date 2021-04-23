<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenresController extends Controller
{
    public function get()
    {
        // $param = Genre::select('id', 'genre_name')->get();
        $param = Genre::get_genres();
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }
}
