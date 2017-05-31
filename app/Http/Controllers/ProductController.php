<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Cart;
use App\GdGood;
use App\Shop;
use App\Shopurl;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    use AuthenticatesUsers;

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
        $products = Product::with(['shopurl', 'brand', 'target', 'shop'])
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

    public function kidIndex(Request $request)
    {
        // Save Form-Input at Session
        $request->flash();

        // Retrive Data from Database
        $products = Product::with(['shopurl', 'brand', 'target', 'shop'])
            ->stock(Input::get('stock'))
            ->target(Input::get('2'))
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

    public function adultIndex(Request $request)
    {
        // Save Form-Input at Session
        $request->flash();

        // Retrive Data from Database
        $products = Product::with(['shopurl', 'brand', 'target', 'shop'])
            ->stock(Input::get('stock'))
            ->target(Input::get('1'))
            ->brand(Input::get('brand'))
            ->shopurl(Input::get('shopurl'))
            ->latest()->paginate(15);
        $shops = Shop::all();
        $shopurls = Shopurl::all();
        $brands = Brand::all();
        dd($products);


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

        $product = Product::with(['shopurl', 'brand', 'target', 'shop'])
            ->find($id);

        return view('products.productDetail', [
            'product' => $product,
        ]);
    }

    public function action(Request $request)
    {


        $request->flash();

        $products = Product::with(['shop', 'brand', 'shopurl'])
            ->wherein('id', Input::get('product_check'))
            ->get();


        foreach ($products as $product) {

            Log::info('Product Controller : ' . 'Checks whether the product is already sent.' .'['. 'Product ID : ' . $product->id .']');
            $result = $product->isExistOnGdGood($product);

            if($result->get('result_code') != '1') {
                Log::error('Product Controller : ' . 'This Product is already sent.' .'['. 'Product ID : ' . $product->id .']');
                return Redirect::back()->with('error_code', '이미전송된 상품입니다.');
            }

            else
            {
                Log::info('Product Controller : ' . 'This Product is available for send to GODO. Start sending.' .'['. 'Product ID : ' . $product->id .']');

                $result = $product->saveProcutOnGdGood($product);

                if($result->get('result_code') == '-1') {
                    return Redirect::back()->with('error_code', '이미전송된 상품입니다.');
                }
                elseif($result->get('result_code') == '-2') {
                    return Redirect::back()->with('error_code', '상품이 보라보라 혹은 고도몰에 존재하지 않습니다.');
                }
                else {
                    Log::info('Product Controller : ' . 'This Product is available for send to GODO. Start sending.' .'['. 'Product ID : ' . $product->id .']');
                    return Redirect::back()->with('error_code', 'null');
                }

            }
        }

    }

    public function new(Request $request)
    {
        $request->flash();

        $start_day = Carbon::now()->subDays(Input::get('daysago'))->format('Y-m-d H:i:s');
        $end_day = Carbon::now()->format('Y-m-d H:i:s');

        $products = Product::with(['shopurl', 'brand', 'target', 'shop'])
            ->where('created_at', '>=', $start_day)
            ->where('created_at', '<=', $end_day)
            ->where('target_is_opened', '=', null)
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


