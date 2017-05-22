<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Shop;
use App\Shopurl;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth::members');
    }
*/

    public function index(Request $request)
    {
        // Save Form-Input at Session
        $request->flash();
        /*
        // Date Test Output
        $input_stock = $request->input('stock');
        $input_target = $request->input('target');
        $input_brand = $request->input('brand');
        $input_shoprul = $request->input('categoryurl');

        echo '<pre>' . print_r("stock : " . $input_stock) . '</pre>';
        echo '<pre>' . print_r("target : " . $input_target) . '</pre>';
        echo '<pre>' . print_r("brand : " . $input_brand) . '</pre>';
        echo '<pre>' . print_r("shopurl : " . $input_shopurl) . '</pre>';
        */
        // Retrive Data from Database
        $products = Product::with(['shopurl','brand','target','shop'])
            ->stock(Input::get('stock'))
            ->target(Input::get('target'))
            ->brand(Input::get('brand'))
            ->shopurl(Input::get('shopurl'))
            ->latest()->paginate(15);
        $shops = Shop::all();
        $shopurls = Shopurl::all();
        $brands = Brand::all();


        // Return Result to View
        return view('products.dashboard', [
            'shopurls' => $shopurls,
            'shops' => $shops,
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        //$request->flash();
        //dd($id);

        $product = Product::with(['shopurl','brand','target','shop'])
            ->find($id);

        return view('products.productDetail', [
            'product' => $product,
        ]);
    }

    public function new(Request $request)
    {
        $request->flash();

        $start_day=Carbon::now()->subDays(Input::get('daysago'))->format('Y-m-d H:i:s');
        $end_day=Carbon::now()->format('Y-m-d H:i:s');

        $products = Product::with(['shopurl','brand','target','shop'])
            ->where('created_at','>=', $start_day)
            ->where('created_at','<=',$end_day)
            ->where('target_is_opened','=',null)
            ->latest()->paginate(15);
        //dd($products);

        return view('products.productNew', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}


