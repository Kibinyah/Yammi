<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Login;
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

$factory->define(Login::class, function (Faker $faker) {
    return [
            'user_id' => User::inRandomOrder()->first()->id,
            'username' => $faker->unique()->userName,
            'password' => $faker->password(),
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
});
