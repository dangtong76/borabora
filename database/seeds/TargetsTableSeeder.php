<?php

use App\Target;
use Illuminate\Database\Seeder;

class TargetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Target::truncate();

        factory(Target::class, 1)->create([
            'name' => 'adult',
            'type' => 'db'
        ]);

        factory(Target::class, 1)->create([
            'name' => 'kid',
            'type' => 'db'
        ]);

    }
}
