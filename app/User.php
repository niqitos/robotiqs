<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'picture', 'provider', 'provider_id', 
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email', 'email_verified_at', 'provider', 'provider_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function initials()
    {
        $initials = explode(' ', $this->name);

        return mb_substr($initials[0], 0, 1, 'utf-8') . 
            (array_key_exists(1, $initials) ? mb_substr($initials[1], 0, 1, 'utf-8') : null);
    }
}
