<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any Articles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $article->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $article->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function restore(User $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function forceDelete(User $user, Article $article)
    {
        //
    }
}
