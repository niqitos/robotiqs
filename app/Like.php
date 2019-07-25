<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RecordActivity;

class Like extends Model
{
    use RecordActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return strtolower(str_plural((new ReflectionClass($this->subject_type))->getShortName())); 
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        if ($this->type() == 'article') {
            return route('article.show', [$this->subject->topic, $this->subject]);
        } elseif ($this->type() == 'comment') {
            return route('article.show', [$this->subject->article->topic, $this->subject->article]) . "#comment-{$this->subject->id}";
        }
    }
}
