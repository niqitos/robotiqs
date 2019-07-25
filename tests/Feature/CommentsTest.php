<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use App\Comment;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class CommentsTest extends TestCase
{
    // public function testGuestsMayNotCommentArticles()
    // {
    //     $article = $this->create(Article::class);
    //     $comment = $this->make(Comment::class, [
    //         'article_id' => $article->id
    //     ]);

    //     $this->withExceptionHandling()
    //         ->post(route('comment.store', $article), $comment->toArray())
    //         ->assertRedirect(route('login'));
    // }

    // public function testAuthenticatedUsersCanCommentArticles()
    // {
    //     $user = $this->create(User::class);
    //     $article = $this->create(Article::class);
    //     $comment = $this->make(Comment::class, [
    //         'article_id' => $article->id
    //     ]);

    //     $this->actingAs($user)
    //         ->post(route('comment.store', $article), $comment->toArray());

    //     $this->get(route('article.show', [$article->topic, $article]))
    //         ->assertSee($comment->body);
    // }

    // public function testACommentRequiresABody()
    // {
    //     $user = $this->create(User::class);
    //     $article = $this->create(Article::class);

    //     $comment = $this->make(Comment::class, [
    //         'article_id' => $article->id,
    //         'body' => null
    //     ]);

    //     $this->actingAs($user)
    //         ->post(route('comment.store', $article), $comment->toArray())
    //         ->assertSessionHasErrors('body');
    // }
}
