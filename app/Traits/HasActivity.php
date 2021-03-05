<?php


namespace App\Traits;


use App\Models\Activity;

trait HasActivity
{
    protected static function bootHasActivity()
    {
        foreach (static::getRecordableEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function($model) {
            $model->activities()->delete();
        });
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function getActivityType($event): string
    {
        return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());
    }

    protected function recordActivity($event)
    {
        if (auth()->guest()) return;

        $this->activities()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    protected static function getRecordableEvents()
    {
        return ['created'];
    }
}
