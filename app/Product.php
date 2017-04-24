<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shopurl()
    {
        return $this->belongsTo(CategoryUrl::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
