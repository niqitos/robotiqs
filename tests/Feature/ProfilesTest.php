<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    public function testAUserHasAProfile()
    {
        $user = $this->create(User::class);

        $this->get(route('profile.show', $user))
            ->assertSee($user->name);
    }

    public function testProfileDisplaysAllArticlesCreatedByAUser()
    {
        $user = $this->create(User::class);

        $this->actingAs($user);

        $article = $this->create(Article::class, [
            'user_id' => $user->id
        ]);

        $this->get(route('profile.show', $user))
            ->assertSee($article->title)
            ->assertSee($article->body);
    }
}