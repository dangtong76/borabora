<?php

use App\Cart;
use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cart::truncate();
        factory(Cart::class,2)->create();
    }
}