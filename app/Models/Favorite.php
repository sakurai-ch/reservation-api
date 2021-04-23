<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public static function post_favorite($favorite_data)
    {
        $param = Favorite::create([
            'user_id' => $favorite_data->user_id,
            'store_id' => $favorite_data->store_id,
        ]);
        return $param;
    }

    public static function delete_favorite($favorite_data)
    {
        Favorite::where('store_id', $favorite_data->store_id)
            ->where('user_id', $favorite_data->user_id)
            ->delete();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(Store::class);
    }

    protected $fillable = [
        "user_id",
        "store_id",
    ];
}
