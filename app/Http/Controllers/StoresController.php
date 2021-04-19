<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::select('store_id', 'store_name', 'area_id', 'genre_id', 'image_url')->get();
        foreach($stores as $store){
            $store['area_name'] = $store->areas()->select('area_name')->first()->area_name;
            $store['genre_name'] = $store->genres()->select('genre_name')->first()->genre_name;
        }
        $areas = Area::select('area_id', 'area_name')->get();
        $genres = Genre::select('genre_id', 'genre_name')->get();
        $param = [
            'stores' => $stores,
            'areas' => $areas,
            'genres' => $genres
        ];
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */

    // public function show(Store $store)
    public function show($store_id)
    {

        // $param = Store::where('store_id',$store->store_id)
        $param = Store::where('store_id',$store_id)
            ->select('store_id', 'description')
            ->first();
        return response()->json([
            'message' => 'OK',
            'data' => $param
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
