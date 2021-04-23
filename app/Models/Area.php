<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public static function get_areas()
    {
        $param = Area::select('id', 'area_name')->get();
        return $param;
    }

    public function store()
    {
        return $this->hasMany(Store::class);
    }
}
