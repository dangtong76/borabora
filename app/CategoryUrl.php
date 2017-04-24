<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryUrl extends Model
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
}
