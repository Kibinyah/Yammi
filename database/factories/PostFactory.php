<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($faker->numberBetween(10,15)),
        'content' => $faker->realText($faker->numberBetween(10,20)),

        'user_id' => User::inRandomOrder()->first()->id,
    ];
});
