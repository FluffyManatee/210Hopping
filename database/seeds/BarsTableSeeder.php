<?php

use Illuminate\Database\Seeder;

class BarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Bar::class, 100)->create();
    }
}
