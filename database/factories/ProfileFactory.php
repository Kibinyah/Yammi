<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
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

$factory->define(Profile::class, function (Faker $faker) {
    return [
            'user_id' => $faker->unique()->numberBetween(1, App\User::count()),
            'name' => $faker->name,
            'dateOfBirth' => $faker->date,
            'bio' => $faker->realText($faker->numberBetween(10,20)),
        ];
});
