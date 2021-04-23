<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static function get_users($user_data){
        $items = User::find($user_data->user_id);
        $param = [
            'id' => $items->id,
            'user_name' => $items->user_name,
            'email' => $items->email
        ];
        return $param;
    }

    public static function post_user($user_data){
        $hashed_password = Hash::make($user_data->password);
        $param = User::create([
            'user_name' => $user_data->user_name,
            'email' => $user_data->email,
            'password' => $hashed_password,
        ]);
        return $param;
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'favorites');
    }

    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
