<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function get(Request $request)
    {
        ($request->store_id == null){
            $param = Reservation::get_user_reservation($request);
        }else{
            $param = Reservation::get_store_reservation($request);
        }
        return response()->json([
            'message' => 'Reservation got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        $param = Reservation::post_reservation($request);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 201);
    }

    public function delete(Request $request)
    {
        Reservation::delete_reservation($request);
        return response()->json([
            'message' => 'Reservation deleted successfully',
        ], 200);
    }

    public function patch(Request $request)
    {
        $param = Reservation:: patch_reservation($request);
        return response()->json([
            'message' => 'Reservation updated successfully',
            'data' => $param
        ], 200);
    }

}
