<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    public static function get_reservation($reservation_data)
    {
        $yesterday = Carbon::now()->addDay(-1);
        $param = Reservation::where('date', '>', $yesterday)
            ->where('user_id', $reservation_data->user_id)
            ->select('id', 'user_id', 'store_id', 'date', 'time', 'num_of_users')
            ->get();
        return $param;
    }

    public static function post_reservation($reservation_data)
    {
        $param = Reservation::create([
            "user_id" => $reservation_data->user_id,
            "store_id" => $reservation_data->store_id,
            "date" => $reservation_data->date,
            "time" => $reservation_data->time,
            "num_of_users" => $reservation_data->num_of_users,
        ]);
        return $param;
    }

    protected $fillable = [
        "user_id",
        "store_id",
        "date",
        "time",
        "num_of_users"
    ];
}
