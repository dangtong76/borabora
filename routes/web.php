<?php


use App\Brand;
use App\Product;
use App\Shopurl;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('members')->group(function () {

    # Member Login Router
    Route::get(
        '/',
        'MemberController@dashboard'
    )->name('members.dashboard');

    Route::get(
        'login',
        'Auth\Member\LoginController@showLoginForm'
    )->name('members.login');

    Route::post(
        'login',
        'Auth\Member\LoginController@login'
    )->name('members.login.submit');

    # Member Register Router

    Route::get(
        'register',
        'Auth\Member\RegisterController@showRegistrationForm'
    )->name('members.register');

    Route::post(
        'register',
        'Auth\Member\RegisterController@register'
    )->name('members.register.submit');

    Route::get(
        'password/reset',
        'Auth\Member\ForgotPasswordController@showLinkRequestForm'
    )->name('password.request');


});

Route::prefix('products')->group(function () {

    # PRODUCT DASHBORAD ROUT
    Route::get(
        '/',
        'ProductController@index'
    )->name('products.index');

    Route::get(
        'adult',
        'ProductController@adultIndex'
    )->name('products.index.adult');

    Route::get(
        'kid',
        'ProductController@kidIndex'
    )->name('products.index.kid');



    Route::get(
        'news',
        'ProductController@new'
    )->name('products.new');


    Route::get(
        '{id}',
        'ProductController@show'
    )->name('products.show');

    Route::post(
        'action',
        'ProductController@action'
    )->name('products.action');


});

Route::prefix('gdgoods')->group(function () {

    # PRODUCT DASHBORAD ROUT
    Route::get(
        '/',
        'GdGoodController@index'
    )->name('gdgoods.index');

    Route::get(
        '{goodsno}',
        'GdGoodController@show'
    )->name('gdgoods.show');

});



Route::prefix('shops')->group(function () {

    Route::get(
        '/',
        'ShopController@index'
    )->name('shops.index');

    // 등록상품검색 카테고리 Select Box 리스트 (Ajax 호출)
    Route::get('{shopId}/category.json', function ($shopId) {
        return shopurl::where('shop_id', $shopId)->select('id', 'category_borabora_name')->get();
    })->name('shops.getCategory');

    // 등록상품검색 브랜드 Select Box 리스트 (Ajax 호출)
    Route::get('{shopId}/brand.json', function ($shopId) {

        $brands = Brand::whereIn('id', function ($query) use ($shopId) {
            $query->select('brand_id')
                ->from(with(new Product)->getTable())
                ->where('shop_id', '=', $shopId);
        })->select('id', 'brand_name')->get();

        return $brands;
    })->name('shops.getBrand');


    Route::get(
        '{shopId}',
        'ShopController@show'
    )->name('shops.show');

    Route::get(
        '{shopid}/shopurls',
        'ShopurlController@index'
    )->name('shopurls.index');

});


Route::prefix('carts')->group(function () {


    Route::get(
        '{memberId}/menus/{menuId}',
        'CartController@index'
    )->name('carts.index');



});






Route::post('logout', 'Auth\Member\LoginController@logout')->name('logout');