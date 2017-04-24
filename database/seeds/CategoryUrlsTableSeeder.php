<?php

use App\CategoryUrl;
use Illuminate\Database\Seeder;

class CategoryUrlsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryUrl::truncate();

        factory(CategoryUrl::class, 10)->create();
    }
}
