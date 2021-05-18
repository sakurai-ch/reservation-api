<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    public static function get_user_reservation($reservation_data)
    {
        $lastManthDate = Carbon::now()->subMonth(1);
        $user_id = auth()->user()->id;
        $param = Reservation::where('date', '>', $lastManthDate)
            // ->where('user_id', $reservation_data->user_id)
            ->where('user_id', $user_id)
            ->where('rating', null)
            ->select('id', 'user_id', 'store_id', 'date', 'time', 'num_of_users', 'rating', 'comment')
            ->orderBy('date')
            ->orderBy('time')
            ->with('store:id,store_name')
            ->get();
        return $param;
    }

    public static function get_store_reservation($reservation_data)
    {

        $param = Reservation::where('id', '=', $reservation_data->store_id)
            ->where('date', '=', $reservation_data->date)
            ->orderBy('time')
            ->with('user:id,user_name,email')
            ->get();
        return $param;
    }

    public static function post_reservation($reservation_data)
    {
        $user_id = auth()->user()->id;
        $param = Reservation::create([
            // "user_id" => $reservation_data->user_id,
            "user_id" => $user_id,
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
                'num_of_users' => $reservation_data->num_of_users,
                'rating' => $reservation_data->rating,
                'comment' => $reservation_data->comment,
            ]);
        $param = Reservation::find($reservation_data->reservation_id);
        return $param;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        "user_id",
        "store_id",
        "date",
        "time",
        "num_of_users",
        "rating",
        "comment",
    ];
}
