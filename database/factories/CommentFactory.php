<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Comment;
use App\Article;
use Faker\Generator as Faker;

// $articles->each(function($article) {factory('App\Comment', 2)->create(['article_id' => $article->id,]);});

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'article_id' => factory(Article::class)->create()->id,
        'user_id' => factory(User::class)->create()->id,
        'body' => $faker->paragraph
    ];
});
