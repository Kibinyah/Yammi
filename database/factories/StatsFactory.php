<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stats;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Stats::class, function (Faker $faker) {
    return [
            'likes' => $faker->numberBetween(0,20),
            'views' => $faker->numberBetween(0,30),
            'statable_id' => $faker->numberBetween(0,40),
            'statable_type' => $faker->randomElement(['Comment', 'Post']),   
        ];
});
