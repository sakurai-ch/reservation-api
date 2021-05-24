<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function post_user($user_data){
        $hashed_password = Hash::make($user_data->password);
        $manager = false;
        if($user_data->manager && auth()->user()->administrator){ $manager = true; }
        $param = User::create([
            'user_name' => $user_data->user_name,
            'email' => $user_data->email,
            'password' => $hashed_password,
            'manager' => $manager,
            'administrator' => false,
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
        'manager',
        'administrator',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
