<?php

namespace App\Traits;

use App\Like;

trait Likeable
{
    protected static function bootLikeable()
    {
        static::deleting(function ($model) {
            $model->likes->each->delete();
        });
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'subject');
    }

    public function like()
    {
        $attributes = [
            'user_id' => auth()->id()
        ];

        if (!$this->likes()->where($attributes)->exists()) {
            return $this->likes()->create($attributes);
        }
    }

    public function unlike()
    {
        $attributes = [
            'user_id' => auth()->id()
        ];

        $this->likes()->where($attributes)->get()->each->delete();
    }

    public function liked()
    {
        return !! $this->likes->where('user_id', auth()->id())->count();
    }

    public function getIsLikedAttribute()
    {
        return $this->liked();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }
}