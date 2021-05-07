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
            ->with('store:id,store_name')
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

    public static function delete_reservation($reservation_data)
    {
        Reservation::where('id', $reservation_data->reservation_id)
            ->delete();
    }

    public static function patch_reservation($reservation_data)
    {
        Reservation::where('id', $reservation_data->reservation_id)
            ->update([
                'date' => $reservation_data->date,
                'time' => $reservation_data->time,
                'num_of_users' => $reservation_data->num_of_users
            ]);
        $param = Reservation::find($reservation_data->reservation_id);
        return $param;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    protected $fillable = [
        "user_id",
        "store_id",
        "date",
        "time",
        "num_of_users"
    ];
}
