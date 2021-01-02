<?php

use Illuminate\Database\Seeder;
use App\Stats;

class StatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Stats::class,40)->create();
    }
}
