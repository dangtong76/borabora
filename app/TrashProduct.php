<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrashProduct extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryUrl::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
