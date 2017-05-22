<?php


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

});

Route::prefix('products')->group(function () {

    # PRODUCT DASHBORAD ROUT
    Route::get(
        '/',
        'ProductController@index'
    )->name('products.index');

    Route::get(
        'news',
        'ProductController@new'
    )->name('products.new');


    Route::get(
        '{id}',
        'ProductController@show'
    )->name('products.show');

});

Route::prefix('shops')->group(function () {

    Route::get(
        '/',
        'ShopController@index'
    )->name('shops.index');

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



Route::get(
    'password/reset',
    'Auth\Member\ForgotPasswordController@showLinkRequestForm'
    )->name('password.request');


Route::post('logout', 'Auth\Member\LoginController@logout')->name('logout');