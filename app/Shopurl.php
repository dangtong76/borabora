<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopurl extends Model
{
    // 테스트 DB 데이타 상수, 셀제 운영시 지울것
    const oriClothing = 'Clothing';
    const oriPants = 'Pants';
    const oriSkirt = 'Skirt';

    Const boraClothing = 'Clothing';
    Const boraPants = 'Pants';
    Const boraSkirt = 'Skirt';



    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeShopid($query, $shopid)
    {

        return $query->where('shop_id','=',$shopid);

    }
}
