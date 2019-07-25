<?php

namespace Tests\Feature;

use Exception;
use App\User;
use App\Article;
use App\Comment;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class LikesTest extends TestCase
{
    public function testGuestCannotLikeAnything()
    {
        $comment = $this->create(Comment::class);

        $article = $this->create(Article::class);

        // $this->withoutExceptionHandling()
        //     ->expectException(AuthenticationException::class);

        $this->post(route('like', ['article', $article]))
            ->assertRedirect(route('login'));

        $this->post(route('like', ['comment', $comment]))
            ->assertRedirect(route('login'));
    }

    public function testAnAuthenticatedUserCanLikeAnyComment()
    {
        $comment = $this->create(Comment::class);
        $user = $this->create(User::class);

        $this->actingAs($user);

        $comment->like();
        
        $this->assertCount(1, $comment->likes);
    }

    public function testAnAuthenticatedUserCanLikeAnyArticle()
    {
        $article = $this->create(Article::class);
        $user = $this->create(User::class);

        $this->actingAs($user);

        $article->like();
        
        $this->assertCount(1, $article->likes);
    }

    public function testAnAuthenticatedUserCanUnlikeAnyComment()
    {
        $comment = $this->create(Comment::class);
        $user = $this->create(User::class);

        $this->actingAs($user);

        $comment->like();
        $comment->unlike();

        $this->assertCount(0, $comment->likes);
    }

    public function testAnAuthenticatedUserCanUnlikeAnyArticle()
    {
        $article = $this->create(Article::class);
        $user = $this->create(User::class);

        $this->actingAs($user);

        $article->like();
        $article->unlike();

        $this->assertCount(0, $article->likes);
    }
}
