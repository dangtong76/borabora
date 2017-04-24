<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Brand;
use App\Cart;
use App\CategoryUrl;
use App\OriginCategory;
use App\Product;
use App\Shop;
use App\Member;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;


$faker = Factory::create('en');

$factory->define(Member::class, function ($faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Shop::class, function () use ($faker) {
    //$genders = Gender::toArray();
    return [
        'name' => $faker->company,
        'homepage' => $faker->url,
        'shop_country' => $faker->countryCode,
    ];
});


$factory->define(CategoryUrl::class, function () use ($faker) {
    $lastShopId = Shop::count();
    $shopId = Shop::find(rand(1, $lastShopId));

    return [
        'shop_id' => $shopId->id,
        'crawl_url' => $faker->url,
        'crawl_type' => 'page',
        'crawl_page_count' => $faker->numberBetween(10, 100),
        'category_origin_name' => OriginCategory::getInstance('Pants'),
        'category_borabora_name' => OriginCategory::getInstance('Pants'),
    ];
});

$factory->define(Product::class, function () use ($faker) {
    print '|';
    //CategoryUrls 테이블에서 1개 Row Random 으로 가져오기
    $lastUrlId = CategoryUrl::count();
    $urlId = CategoryUrl::find(rand(1,$lastUrlId));

    //Brands 테이블에서 1개 Row Random 으로 가져오기
    $lastBrandId = Brand::count();
    $brandId = Brand::find(rand(1,$lastBrandId));

    return [
        'shop_id' => $urlId->shop_id,
        'shop_category_url_id' => $urlId->id,
        'brand_id' => $brandId->id,
        'sku_id' => $faker->word . '-' . $faker->randomNumber(3,false),
        'name' => $faker->word,
        'color' => $faker->colorName,
        'short_DESC' => $faker->sentence(10),
        'long_DESC'  => $faker->sentence(15),
        'launch_date' => $faker->dateTimeThisMonth,
        'option_type' => 'single',
        'option_name' => 'stock/price',
        'option' => '1',
        'event_price' =>  rand(250000, 3000000),
        'price' => rand(250000,3000000),
        'is_taxation' => '1',
        'memo' => $faker->sentence(20),
        'extra_title' => $faker->title,
        'extra_1' => $faker->sentence(20),
        'extra_2' => $faker->sentence(20),
        'img_count' => $faker->numberBetween(1, 10),
        'img_urls' => $faker->imageUrl(30,5),
        'crawl_active' => '1',
        'crawl_last_time' => $faker->dateTimeThisYear,
        'crawl_last_status' => 'success',
        'crawl_url' => $faker->url,
        'hash_img' => Hash::make('img_urls'),
        'hash_price' => Hash::make('price'),
        'hash_option' => Hash::make('option'),
    ];
});


$factory->define(Cart::class, function () use ($faker) {

    //Members 테이블에서 1개 Row Random 으로 가져오기
    $totalMember = Member::count();
    $pickedMember = Member::find(rand(1, $totalMember));

    return [
        'product_id' => rand(1, 99),
        'member_id' => $pickedMember->id,
    ];
});
