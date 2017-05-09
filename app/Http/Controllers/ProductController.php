<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryUrl;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        // Save Form-Input at Session
        $request->flash();
        /*
        // Date Test Output
        $input_stock = $request->input('stock');
        $input_target = $request->input('target');
        $input_brand = $request->input('brand');
        $input_categoryurl = $request->input('categoryurl');

        echo '<pre>' . print_r("stock : " . $input_stock) . '</pre>';
        echo '<pre>' . print_r("target : " . $input_target) . '</pre>';
        echo '<pre>' . print_r("brand : " . $input_brand) . '</pre>';
        echo '<pre>' . print_r("categoryurl : " . $input_categoryurl) . '</pre>';
        */
        // Retrive Data from Database
        $products = Product::with(['categoryurl','brand','target','shop'])
            ->stock(Input::get('stock'))
            ->target(Input::get('target'))
            ->brand(Input::get('brand'))
            ->categoryurl(Input::get('categoryurl'))
            ->latest()->paginate(15);
        $categoryurls = CategoryUrl::all();
        $brands = Brand::all();

        // Return Result to View
        return view('products.dashboard', [
            'categoryurls' => $categoryurls,
            'brands' => $brands,
            'products' => $products,
        ]);
    }

    public function show($id)
    {
        //$request->flash();
        //dd($id);

        $product = Product::with(['categoryUrl','brand','target','shop'])
            ->find($id);

        return view('products.productDetail', [
            'product' => $product,
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


