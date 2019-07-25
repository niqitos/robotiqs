<?php

namespace Tests\Unit;

use App\User;
use App\Article;
use App\Comment;
use App\Activity;
use Tests\TestCase;
use Carbon\Carbon;

class ActivityTest extends TestCase
{
    public function testRecordAnActivityWhenAnArticleIsCreated()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);
        $article = $this->create(Article::class);

        $this->assertDatabaseHas('activities', [
            'type' => 'created',
            'user_id' => auth()->id(),
            'subject_id' => $article->id,
            'subject_type' => get_class($article)
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $article->id);
    }

    public function testRecordAnActivityWhenACommentIsCreated()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);
        $comment = $this->create(Comment::class);

        $this->assertDatabaseHas('activities', [
            'type' => 'created',
            'user_id' => auth()->id(),
            'subject_id' => $comment->id,
            'subject_type' => get_class($comment)
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $comment->id);
    }

    public function testFetchAFeedForAnyUser()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);
        
        $this->create(Article::class, [
            'user_id' => auth()->id()
        ], 2);

        $user->activity()->first()->update([
            'created_at' => Carbon::now()->subWeek()
        ]);

        $activities = $user->activity()->feed();

        $this->assertTrue($activities->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $this->assertTrue($activities->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}
