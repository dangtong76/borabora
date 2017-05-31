<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Product extends Model implements Sendable
{
    use CanBeSend;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function shopurl()
    {
        return $this->belongsTo(Shopurl::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function target()
    {
        return $this->belongsTo(Target::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // GoDo Mall 상품 테이블 relationship(borabora.products and balaan3_co_kr.gd_goods)
    public function gdgood()
    {
        return $this->hasOne(GdGood::class);
    }

    // Eloquent Query Scope
    public function scopeBrand($query, $brand)
    {
        if ($brand) {
            return $query->where('brand_id','=',$brand);
        }
        return $query;
    }
    public function scopeShopurl($query, $shopurl)
    {
        if ($shopurl) {
            return $query->where('shopurl_id','=',$shopurl);
        }
        return $query;
    }

    public function scopeStock($query, $stock)
    {
        if ($stock == '1') {
            return $query->where('stock_max','>=','1');
        }
        elseif ($stock =='0') {
            return $query->where('stock_max','=','0');
        }
        return $query;
    }

    public function scopeTarget($query, $target)
    {

        if ($target =='3') {
            return $query->where('target_id','=','1')->orwhere('target_id','=','2');
        }

        elseif ($target == '2') {
            return $query->where('target_id','=','2');
        }

        elseif ($target =='1') {
            return $query->where('target_id','=','1');
        }
        elseif ($target == '0') {
            return $query->where('target_id','=',null);
        }
        return $query;
    }

    public function scopeId($query, $id)
    {
        if(isset($id)) {
            return $query->where('id','=', $id);
        }

    }
}
