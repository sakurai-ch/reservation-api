<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public static function get_genres()
    {
        $param = Genre::select('id', 'genre_name')->get();
        return $param;
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
