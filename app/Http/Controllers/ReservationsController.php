<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Carbon\Carbon;
use App\Models\Reservation;

class ReservationsController extends Controller
{
    public function get(Request $request)
    {
        // $yesterday = Carbon::now()->addDay(-1);
        // $param = Reservation::where('date', '>', $yesterday) 
        //     ->where('user_id', $request->user_id)
        //     ->select('id', 'user_id', 'store_id','date', 'time', 'num_of_users')
        //     ->get();
        $param = Reservation::get_reservation($request);
        return response()->json([
            'message' => 'Reservation got successfully',
            'data' => $param
        ], 200);
    }

    public function post(Request $request)
    {
        // $param = Reservation::create([
        //     "user_id" => $request->user_id,
        //     "store_id" => $request->store_id,
        //     "date" => $request->date,
        //     "time" => $request->time,
        //     "num_of_users" => $request->num_of_users,
        // ]);
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
