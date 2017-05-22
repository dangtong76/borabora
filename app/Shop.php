<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function Products()
    {
        return $this->hasMany(Product::class);
    }

    public function product_count() {
        return $this->hasMany(Product::class)->selectRaw('count(*) as count')->groupBy('products.id');
    }

    public function TrashProducts()
    {
        return $this->hasMany(TrashProduct::class);
    }

    public function Shopurls()
    {
        return $this->hasMany(Shopurl::class);
    }
}
