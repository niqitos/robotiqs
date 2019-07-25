<?php

namespace App\Traits;

use App\Activity;

trait RecordActivity
{
    protected static function bootRecordActivity()
    {
        if (auth()->guest()) return;
        
        foreach(static::getActivityEvents() as $event) {
            static::created(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    /**
     * Fetch the activity relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected static function getActivityEvents()
    {
        return ['created'];
    }
    
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $event
        ]);
    }
}