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

        //Generates 20 comments using Comment factory
        factory(App\Comment::class,20)->create();
    }
}
