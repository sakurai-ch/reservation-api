<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
