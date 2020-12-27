<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dummy Seed
        $c1 = new Comment;
        $c1 -> comment = "I also agree";
        $c1 -> post_id = 4;
        $c1 -> user_id = 3;
        $c1 -> save();

        //Generates 20 comments using Comment factory
        factory(App\Comment::class,20)->create();
    }
}
