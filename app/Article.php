<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;
use App\Traits\RecordActivity;
use App\Traits\FormatDate;
use App\Traits\Likeable;
use Carbon\Carbon;

class Article extends LikeableModel
{
    use RecordActivity,
        Likeable,
        FormatDate,
        SoftDeletes;

    protected $guarded = [];

    protected $with = ['author', 'topic', 'likes'];

    protected $withCount = ['comments'];

    protected $appends = ['likesCount', 'isLiked', 'createdAtForHumans'];

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($article) {
            $article->comments->each->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsDeclension()
    {
        return Lang::choice('messages.comments', $this->comments_count);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function addComment($comment)
    {
        return $this->comments()->create($comment);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('comments_count', 'desc')->latest();
    }

    public function scopeFilter($query)
    {
        switch (collect(request()->segments())->last()) {
            case 'today':
                return $query->popular()
                    ->whereDate('created_at', Carbon::today());
            case 'week':
                return $query->popular()
                    ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
            case 'month':
                return $query->popular()
                    ->whereBetween('created_at', [Carbon::now()->subMonth(1), Carbon::now()]);
            case 'year':
                return $query->popular()
                    ->whereBetween('created_at', [Carbon::now()->subYear(1), Carbon::now()]);
            case 'alltime':
                return $query->popular();
            case 'latest':
                return $query->latest();
            default:
                return $query->popular();
        }
    }
}
