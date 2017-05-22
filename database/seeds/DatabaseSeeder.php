<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeyChecks();

        $this->call(BrandsTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(ShopurlsTableSeeder::class);
        $this->call(TargetsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(CartsTableSeeder::class);

        $this->restoreForeignKeyChecks();
    }

    protected function disableForeignKeyChecks()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function restoreForeignKeyChecks()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
