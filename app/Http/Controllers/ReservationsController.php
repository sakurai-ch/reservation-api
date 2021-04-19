<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function get(Request $request)
    {
        $now = Carbon::now();
        $param = Reservation::where('date', '>', $now) 
            ->where('user_id', $request->user_id)
            ->select('reservation_id', 'user_id', 'store_id','date', 'time', 'num_of_users')
            ->get();
        return response()->json([
            'message' => 'Reservation got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        $now = Carbon::now();
        $items = [
            "user_id" => $request->user_id,
            "store_id" => $request->store_id,
            "date" => $request->date,
            "time" => $request->time,
            "num_of_users" => $request->num_of_users,
            "created_at" => $now,
            "updated_at" => $now
        ];
        Reservation::insert($items);
        $param = Reservation::where('user_id', $request->user_id)
            ->where('store_id', $request->store_id)
            ->first();
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 200);
    }

    public function delete(Request $request)
    {
        Reservation::where('reservation_id', $request->reservation_id)
            ->delete();
        return response()->json([
            'message' => 'Reservation deleted successfully',
        ], 200);
    }

}
