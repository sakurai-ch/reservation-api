<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{
    use HasFactory;

    public static function index_stores($user_data)
    {
        $user_favorites = Favorite::where('user_id', $user_data->user_id);
        $param = Store::select('stores.id', 'store_name', 'area_id', 'genre_id', 'image_url', 'user_favorites.user_id')
            ->with('area:id,area_name', 'genre:id,genre_name')
            ->leftJoinSub($user_favorites ,'user_favorites',function ($join) {
                $join->on('stores.id', '=', 'user_favorites.store_id');
            })
            ->get();
        return $param;
    }

    public static function show_store($user_data, $store_id)
    {
        $param = Store::with('area:id,area_name', 'genre:id,genre_name')->find($store_id);
        $param['user_id'] = $param->users()->where('user_id', $user_data->user_id)->value('user_id');
        return $param;
    }

    public static function update_store($store_data, $store_id)
    {
        Validator::validate($store_data, [
            'file' => ['required', 'file', 'image', 'mimes:jpeg,png']
        ]);
        $file = $store_data->file('file');
        $upload_info = Storage::disk('s3')->putFile('/', $file);
        $path = Storage::disk('s3')->url($upload_info);

        Store::where('id', $store_id)
            ->update([
                'image_url' => $path,
            ]);
        $param = Store::find($store_id);
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

    public function favorites()
    {
        return $this->hasMany(Favorites::class);
    }

    protected $fillable = [
        "store_name",
    ];
}
