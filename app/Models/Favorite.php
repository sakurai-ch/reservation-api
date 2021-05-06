<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public static function post_favorite($favorite_data)
    {
        User::find($favorite_data->user_id)->stores()->attach($favorite_data->store_id);
        // $param = Favorite::where('user_id', $favorite_data->user_id)->where('store_id', $favorite_data->store_id)->get();
        // return $param;
    }

    public static function delete_favorite($favorite_data)
    {
        User::find($favorite_data->user_id)->stores()->detach($favorite_data->store_id);
    }

    protected $fillable = [
        "user_id",
        "store_id",
    ];
}
