<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    public static function get_stores_name()
    {
        $user_id = auth()->user()->id;
        $param = Manager::where('user_id', $user_id)
            ->select('user_id', 'store_id')
            ->orderBy('store_id')
            ->with('store:id,store_name')
            ->get();
        return $param;
    }

    public static function post_manager($manager_data)
    {
        $param = Manager::create([
            'user_id' => $manager_data->user_id,
            'store_id' => $manager_data->store_id,
        ]);
        return $param;
    }

    public static function delete_manager($manager_data)
    {
        Manager::where('user_id', $manager_data->user_id)
            ->where('store_id', $manager_data->store_id)
            ->delete();
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
