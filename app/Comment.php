<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RecordActivity;
use App\Traits\FormatDate;
use App\Traits\Likeable;

class Comment extends LikeableModel
{
    use RecordActivity,
        Likeable,
        FormatDate,
        SoftDeletes;

    protected $guarded = [];

    protected $with = ['creator', 'likes', 'article'];

    protected $appends = ['likesCount', 'isLiked', 'createdAtForHumans'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
