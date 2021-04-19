<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function areas()
    {
        return $this->belongsTo(Area::class, 'area_id', 'area_id');
    }

    public function genres()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'genre_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'store_id', 'store_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'store_id', 'user_id');
    }
}
