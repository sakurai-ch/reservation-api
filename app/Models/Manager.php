<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    public static function get_user_Manager()
    {
        $user_id = auth()->user()->id;
        $param = Manager::where('user_id', $user_id)
            ->select('user_id', 'store_id')
            ->orderBy('store_id')
            ->with('store:id,store_name')
            ->get();
        return $param;
    }

    public static function get_store_Manager($manager_data)
    {
        $param = Manager::where('store_id', $manager_data->store_id)
            ->orderBy('user_id')
            ->with('user:id,user_name,email')
            ->get();
        return $param;
    }

    public static function post_manager($manager_data)
    {
        $user_id = auth()->user()->id;
        User::find($user_id)->stores()->attach($manager_data->store_id);
    }

    public static function delete_manager($manager_data)
    {
        $user_id = auth()->user()->id;
        User::find($user_id)->stores()->detach($manager_data->store_id);
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
    ];
}