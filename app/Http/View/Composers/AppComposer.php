<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Topic;
use Cookie;
use Route;
use Cache;

class AppComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        switch(url()->current()) {
            case route('articles.today'):
                $popularTabName = __('Today');
                break;
            case route('articles.week'):
                $popularTabName = __('This Week');
                break;
            case route('articles.month'):
                $popularTabName = __('This Month');
                break;
            case route('articles.year'):
                $popularTabName = __('This Year');
                break;
            case route('articles.alltime'):
                $popularTabName = __('All Time');
                break;
            default:
                $popularTabName = false;
        }

        $routeIsTopic = Route::current() 
            ? (Route::current()->getName() == 'topic.show')
            : null;

        $topics = Cache::rememberForever('topics', function() {
            return Topic::select('id', 'slug', 'name')->orderBy('name')->get();
        });

        $view->with('theme', Cookie::get('theme') ?: 'light')
             ->with('popularTabName', $popularTabName)
             ->with('routeIsTopic', $routeIsTopic)
             ->with('topics', $topics);
    }
}