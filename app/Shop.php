<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function TrashProducts()
    {
        return $this->hasMany(TrashProduct::class);
    }

    public function CategoryUrls()
    {
        return $this->hasMany(CategoryUrl::class);
    }
}
