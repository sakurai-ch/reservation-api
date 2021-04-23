<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public static function index_stores($user_data)
    {
        $param = Store::select('id', 'store_name', 'area_id', 'genre_id', 'image_url')->get();
        foreach ($param as $item) {
            $item['area_name'] = $item->area()->value('area_name');
            $item['genre_name'] = $item->genre()->value('genre_name');
            $item['user_favorite'] = $item->users()->where('user_id', $user_data->user_id)->exists();
        }
        return $param;
    }

    public static function show_store($user_data, $store_id)
    {
        $param = Store::find($store_id);
        $param['area_name'] = $param->area()->value('area_name');
        $param['genre_name'] = $param->genre()->value('genre_name');
        $param['user_favorite'] = $param->users()->where('user_id', $user_data->user_id)->exists();
        return $param;
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
