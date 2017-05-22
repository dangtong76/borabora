<?php

namespace App\Http\Controllers;

use App\Shopurl;
use Illuminate\Http\Request;

class ShopurlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $shopid)
    {
        $request->flash();
        $shopurls = Shopurl::with(['products'])
            ->where('shop_id','=',$shopid)
            ->latest()->paginate(20);

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
     * Display the specified resource.
     *
     * @param  \App\Shopurl  $shopCategoryUrl
     * @return \Illuminate\Http\Response
     */
    public function show(Shopurl $shopCategoryUrl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shopurl  $shopCategoryUrl
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopurl $shopCategoryUrl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shopurl  $shopCategoryUrl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopurl $shopCategoryUrl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shopurl  $shopCategoryUrl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopurl $shopCategoryUrl)
    {
        //
    }


}
