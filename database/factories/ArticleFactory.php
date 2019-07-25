<?php

/* @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use App\User;
use App\Article;
use Faker\Generator as Faker;

// $articles = factory('App\Article', 10)->create();

$factory->define(Article::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $topic = factory(Topic::class)->create();
    $title = $faker->unique()->sentence;

    return [
        'user_id' => $user->id,
        'topic_id' => $topic->id,
        'slug' => preg_replace('/\s+/', '-', $title),
        'title' => $title,
        'body' => $faker->paragraph
    ];
});
