<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function get(Request $request)
    {
        $param = Reservation::get_reservation($request);
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
        Reservation::where('id', $request->reservation_id)
            ->delete();
        return response()->json([
            'message' => 'Reservation deleted successfully',
        ], 200);
    }

}
