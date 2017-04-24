<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // 테스트 DB 데이타 상수, 셀제 운영시 지울것
    const GUCCI = 'GUCCI';
    const BALENCIAGA = 'BALENCIAGA';
    const CHLOE = 'CHLOE';


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
