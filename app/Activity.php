<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['subject'];

    public function subject()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return strtolower(str_plural((new ReflectionClass($this->subject_type))->getShortName())); 
    }

    public function scopeFeed($query)
    {
        switch (collect(request()->segments())->last()) {
            case 'articles':
                return $query->filterBy(Article::class);
            case 'comments':
                return $query->filterBy(Comment::class);
            case 'liked-articles':
                return $query->filterBy(Like::class)
                    ->whereHasMorph('subject', Like::class, function($q) {
                        $q->where('subject_type', Article::class);
                    })->with('subject.subject');
            case 'liked-comments':
                return $query->filterBy(Like::class)
                    ->whereHasMorph('subject', Like::class, function($q) {
                        $q->where('subject_type', Comment::class);
                    })->with('subject.subject');
            default:
                return $query->filterBy(Article::class);
        }
    }

    public function scopeFilterBy($query, $class)
    {
        // return $query->where('subject_type', $class)->latest()->paginate(5)->groupBy(function ($activity) {
        //     return $activity->created_at->formatLocalized('%d %b, %Y');
        // });
        return $query->where('subject_type', $class)->latest();
    }
}
