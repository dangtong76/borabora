<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();
        collect([
            Brand::GUCCI,
            Brand::BALENCIAGA,
            Brand::CHLOE,
        ])->each(function ($brand) {
            (new Brand)->forceFill([
                'brand_name' => $brand,
            ])->save();
        });
    }
}
