<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
