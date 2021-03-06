<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Shopurl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Save Form-Input at Session

        $request->flash();
        $shops = Shop::with('products')->latest()->paginate(15);
        //$count=$shops->first();
        //dd($count);

        // Return Result to View
        return view('shops.shops', [
            'shops' => $shops,
        ]);
    }


    public function show(Request $request, $id)
    {
        $request->flash();
        $shopurls = Shopurl::with(['shop','products'])
            ->shopid($id)
            ->latest()->paginate(15);

        return view('shops.shopurls', [
            'shopurls' => $shopurls,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
