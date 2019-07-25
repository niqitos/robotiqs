<?php

/* @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    
    return [
        'name' => $name,
        'username' => preg_replace('/\s+/', '-', $name),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt($faker->word),
        'remember_token' => Str::random(10)
    ];
});
