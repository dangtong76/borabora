<?php

use App\Shopurl;
use Illuminate\Database\Seeder;

class ShopurlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shopurl::truncate();

        factory(Shopurl::class, 10)->create();
    }
}
