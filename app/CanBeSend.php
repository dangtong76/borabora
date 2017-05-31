<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use InvalidArgumentException;

trait CanBeSend
{

    public function isExistOnGdGood($product)
    {

        if($product->target_product_id)
        {
            Log::info('CanBeSend Trait(isExistOnGdGood) : ' . 'Already Sended-information exist in Product Table' .'['. 'Product ID : ' . $product->id .']');
            return collect([
                'result_code' => '-3',
                'erro_message' =>'Already Sended-information exist in Product Table',
            ]);
        }
        else
        {
            return collect([
                'result_code' => '1',
                'erro_message' =>'null',
            ]);
        }

    }

    public function saveProcutOnGdGood($product)
    {

        try {
            DB::beginTransaction();

            $GdGood = GdGood::create([
                'goodsnm' => $product->name,
                'origin' => $product->shop->shop_country,
                'maker' => $product->brand->brand_name,
                'keyword' => $product->sku_id,
                'shortdesc' => $product->short_DESC,
                'longdesc' => $product->long_DESC,
                'mlongdesc' => $product->long_DESC,
                'img_i' => 'borabora_test',
                'img_x' => 'borabora_test',
                'img_y' => 'borabora_test',
                'img_z' => 'borabora_test',
                'img_mobile' => 'borabora_test',
                'memo' => $product->memo,
                'regdt' => Carbon::now()->toDateTimeString(),
                'optnm' => 'size',
                'totstock' => $product->stock_max,
                'useblog' => '',
                'inpk_dispno' => '',
                'inpk_prdno' => '',
                'inpk_regdt' => Carbon::now()->toDateTimeString(),
                'inpk_moddt' => Carbon::now()->toDateTimeString(),
                'sales_range_start' => '0',
                'sales_range_end' => '0',
                'goods_price' => $product->price,
                'borabora_sku_id' => $product->sku_id,
                'borabora_product_id' => $product->id,
            ]);


            $product->target_product_id = $GdGood->goodsno;
            $product->save();
            Log::info('CanBeSend Trait : ' . 'save success');


            if (!$GdGood && !$product) {
                Log::error('CanBeSend Trait : ' . 'Rollback');
                DB::rollBack();
                return collect([
                    'result_code' => '-2',
                    'erro_message' =>'unknown error',
                ]);

            }

            DB::commit();
            Log::info('CanBeSend Trait : ' . 'Send success' .'['. 'Product ID : ' . $product->id .']');
            return collect([
                'result_code' => '1',
                'erro_message' =>'null',
            ]);

        } catch (QueryException $ex) {
            Log::error('CanBeSend Trait : ' . $ex->getMessage());
            return collect([
                'result_code' => '-1',
                'erro_message' => $ex->getMessage(),
                ]);
        }


    }
}
