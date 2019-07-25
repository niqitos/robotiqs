<?php

namespace Tests\Feature;

use App\User;
use App\Comment;
use App\Article;
use App\Topic;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class ArticlesTest extends TestCase
{
    // public function testUsersCanViewAllArticles()
    // {
    //     $article = $this->create(Article::class);

    //     $this->get(route('index'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.today'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.week'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.month'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.year'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.alltime'))
    //         ->assertSee($article->title);

    //     $this->get(route('articles.latest'))
    //         ->assertSee($article->title);

    public function testUsersCanReadASingleArticle()
    {
        $article = $this->create(Article::class);

        $this->get(route('article.show', [$article->topic, $article]))
            ->assertSee($article->topic->name)
            ->assertSee($article->author->name)
            ->assertSee($article->title)
            ->assertSee($article->body);
    }

    // public function testUsersCanReadCommentsAssociatedWithAnArticle()
    // {        
    //     $article = $this->create(Article::class);
    //     $comment = $this->create(Comment::class, [
    //         'article_id' => $article->id
    //     ]);

    //     $this->get(route('article.show', [$article->topic, $article]))
    //         ->assertSee($comment->body);
    // }

    public function testGuestsMayNotCreateArticles()
    {
        $this->withoutExceptionHandling()
            ->expectException(AuthenticationException::class);

        $article = $this->make(Article::class);

        $this->get(route('article.create'))
            ->assertRedirect(route('login'));

        $this->post(route('article.store'), $article->toArray())
            ->assertRedirect(route('login'));
    }

    // public function testAuthenticatedUsersCanCreateArticles()
    // {
    //     $user = $this->create(User::class);
    //     $article = $this->make(Article::class, [
    //         'slug' => 'some-title', 
    //         'title' => 'Some Title', 
    //         'body' => 'Some body.'
    //     ]);

    //     $this->actingAs($user);

    //     $this->post(route('article.store'), $article->toArray());
        
    //     $this->get(route('article.show', [$article->topic, $article]))
    //         ->assertSee('Some Title')
    //         ->assertSee('Some body.');
    // }

    // public function testAnArticleRequiresATitle()
    // {
    //     $user = $this->create(User::class);
    //     $article = $this->make(Article::class, [
    //         'title' => null,
    //         'body' => null,
    //         'topic_id' => 999,
    //     ]);

    //     $this->actingAs($user)
    //         ->post(route('article.store'), $article->toArray())
    //         ->assertSessionHasErrors(['title', 'body', 'topic_id']);
    // }

    // public function testAUserCanFilterArticlesByATopic()
    // {
    //     $topic = $this->create(Topic::class);
    //     $articleInTopic = $this->create(Article::class, [
    //         'topic_id' => $topic->id
    //     ]);
    //     $articleNotInTopic = $this->create(Article::class);

    //     $this->get(route('topic.show', $topic))
    //         ->assertSee($articleInTopic->title)
    //         ->assertDontSee($articleNotInTopic->title);
    // }

    public function testFilterArticlesByAnAuthor() 
    {
        $johnDoe = $this->create(User::class, [
            'name' => 'John Doe'
        ]);

        $notJohnDoe = $this->create(User::class, [
            'name' => 'Not John Doe'
        ]);

        // $this->actingAs($user);
        $articleByJohn = $this->actingAs($johnDoe)->create(Article::class);
        $articleNotByJohn = $this->actingAs($notJohnDoe)->create(Article::class);


        $this->get(route('profile.show', $johnDoe))
            ->assertSee($articleByJohn->title)
            ->assertDontSee($articleNotByJohn->title);
    }

    public function testUnauthorizedUsersMayNotDeleteArticles()
    {
        $article = $this->create(Article::class);
        $user = $this->create(User::class);

        $this->delete(route('article.destroy', $article))
            ->assertRedirect(route('login'));
        
        $this->actingAs($user)
            ->delete(route('article.destroy', $article))
            ->assertStatus(403);
    }

    public function testAuthorizedUsersCanDeleteArticles()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);

        $article = $this->create(Article::class, [
            'user_id' => $user->id
        ]);
        $comment = $this->create(Comment::class, [
            'article_id' => $article->id
        ]);

        $this->delete(route('article.destroy', $article))
            ->assertRedirect(route('index'));

        $this->assertSoftDeleted('articles', $article->setAppends([])->toArray());
        $this->assertSoftDeleted('comments', $comment->setAppends([])->toArray());
        $this->assertSoftDeleted('activities', [
            'subject_id' => $article->id,
            'subject_type' => get_class($article),
        ]);
        $this->assertSoftDeleted('activities', [
            'subject_id' => $comment->id,
            'subject_type' => get_class($comment),
        ]);
    }

    public function testUnauthorizedUsersCannotDeleteComments()
    {
        $comment = $this->create(Comment::class);
        $user = $this->create(User::class);

        $this->delete(route('comment.destroy', $comment))
            ->assertRedirect(route('login'));

        $this->actingAs($user)
            ->delete(route('comment.destroy', $comment))
            ->assertStatus(403);
    }

    public function testAuthorizedUsersCanDeleteComments()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);

        $comment = $this->create(Comment::class, [
            'user_id' => $user->id
        ]);

        $this->delete(route('comment.destroy', $comment))
            ->assertStatus(302);

        $this->assertSoftDeleted('comments', $comment->setAppends([])->toArray());
    }

    public function testUnauthorizedUsersCannotUpdateComments()
    {
        $comment = $this->create(Comment::class);
        $user = $this->create(User::class);

        $this->patch(route('comment.update', $comment))
            ->assertRedirect(route('login'));

        $this->actingAs($user)
            ->patch(route('comment.update', $comment))
            ->assertStatus(403);
    }

    public function testAuthorizedUsersCanUpdateComments()
    {
        $user = $this->create(User::class);
        $this->actingAs($user);

        $comment = $this->create(Comment::class, [
            'user_id' => $user->id
        ]);

        $updatedBody = 'Updated body';

        $this->patch(route('comment.update', $comment), [
                'body' => $updatedBody
            ]);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'body' => $updatedBody
        ]);
    }
}
