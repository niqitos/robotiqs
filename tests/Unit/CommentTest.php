<?php

namespace Tests\Unit;

use App\User;
use App\Article;
use App\Comment;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCommentHasACreator()
    {
        $article = $this->create(Article::class);
        $comment = $this->make(Comment::class, [
            'article_id' => $article->id
        ]);

        $this->assertInstanceOf(User::class, $comment->creator);
    }
}
