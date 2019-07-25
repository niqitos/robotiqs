<?php

namespace Tests\Unit;

use App\User;
use App\Article;
use App\Topic;
use Tests\TestCase;

class TopicTest extends TestCase
{
    public function testATopicConsistsOfArticles()
    {
        $topic = $this->create(Topic::class);
        $article = $this->create(Article::class, [
            'topic_id' => $topic->id
        ]);

        $this->assertTrue($topic->articles->contains($article));
    }
}
