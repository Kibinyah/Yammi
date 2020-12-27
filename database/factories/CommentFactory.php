<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;

use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->realText($faker->numberBetween(10,20)),

        'post_id' => Post::inRandomOrder()->first()->id,
        
        'user_id' => User::inRandomOrder()->first()->id,
        
    ];
});
