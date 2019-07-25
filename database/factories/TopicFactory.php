<?php

/* @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => $name
    ];
});
