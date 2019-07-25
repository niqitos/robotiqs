<?php

namespace Tests\Unit;

use App\User;
use App\Topic;
use App\Article;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ArticleTest extends TestCase
{
    public function testAnArticleHasAnAuthor()
    {
        $article = $this->create(Article::class);

        $this->assertInstanceOf(User::class, $article->author);
    }

    public function testAnArticleHasComments()
    {
        $article = $this->create(Article::class);

        $this->assertInstanceOf(Collection::class, $article->comments);
    }

    public function testCommentsCanBeAddedToAnArticle()
    {
        $article = $this->create(Article::class);

        $article->addComment([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $article->comments);
    }

    public function testAnArticleBelongsToATopic()
    {
        $article = $this->create(Article::class);

        $this->assertInstanceOf(Topic::class, $article->topic);
    }
}
