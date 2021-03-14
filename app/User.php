<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'piva', 'restaurant_name', 'restaurant_description', 'restaurant_logo', 'restaurant_banner', 'address', 'phone_number', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plates()
    {
        return $this->hasMany(Plate::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function typologies()
    {
        return $this->belongsToMany(Typology::class);
    }
}
