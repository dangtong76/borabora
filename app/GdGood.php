<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GdGood extends Model
{
    // BoraBora 상품 테이블 relationship(borabora.products and balaan3_co_kr.gd_goods)
    public $timestamps = false;
    protected $connection = 'gdshop';
    protected $primaryKey = 'goodsno';

    protected $fillable = [
        'goodsnm',
        'origin',
        'maker',
        'keyword',
        'shortdesc',
        'longdesc',
        'mlongdesc',
        'img_i',
        'img_x',
        'img_y',
        'img_z',
        'img_mobile',
        'memo',
        'regdt',
        'optnm',
        'totstock',
        'useblog',
        'goods_price',
        'inpk_dispno',
        'inpk_prdno',
        'inpk_regdt',
        'inpk_moddt',
        'sales_range_start',
        'sales_range_end',
        'borabora_sku_id',
        'borabora_product_id'
    ];

    public function product()
    {

        return $this->belongsTo(Product::class,'borabora_product_id','goodsno');

    }
}
