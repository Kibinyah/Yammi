<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dummy Seed
        //Generates 20 Posts using Post factory
        factory(App\Post::class,10)->create();
    }
}
