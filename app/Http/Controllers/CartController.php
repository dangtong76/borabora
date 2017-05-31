<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($memberId, $menuId)
    {
        $id=Auth::id();

        $send_all_carts=Cart::with('product')
            ->where('member_id','=',$id)
            ->where('cart_type','=','1')->latest()->paginate(15);
        $send_price_carts=Cart::with('product')
            ->where('member_id','=',$id)
            ->where('cart_type','=','2')->latest()->paginate(15);

        $delete_carts=Cart::with('product')
            ->where('member_id','=',$id)
            ->where('cart_type','=','3')->latest()->paginate(3);

        //dd($send_all_carts);

        return view('carts.board', [
            'send_all_carts' => $send_all_carts,
            'send_price_carts' => $send_price_carts,
            'delete_carts' => $delete_carts,
            'memberId' => $memberId,
            'menuId' => $menuId,
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
