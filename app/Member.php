<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $guard = 'members';

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
