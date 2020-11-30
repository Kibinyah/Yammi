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
        $p1 = new Post;
        $p1 -> title = "Hi";
        $p1 -> content = "I find coding really fun";
        $p1 -> user_id = 1;
        $p1 -> save();

        //Generates 20 Posts using Post factory
        factory(App\Post::class,20)->create();
    }
}
