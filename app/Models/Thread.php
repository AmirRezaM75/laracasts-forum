<?php

namespace App\Models;

use App\Filters\ThreadFilters;
use App\Notifications\ThreadSubscription;
use App\Traits\HasActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory, HasActivity;

    protected $guarded = [];

    protected $with = ['user', 'category'];

    //TODO: Append isSubscribedTo attribute?!

    public static function booted()
    {
        static::addGlobalScope('REPLIES_COUNT', function($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function($thread) {
            $thread->replies->each->delete();
        });
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscriptions');
    }

    public function path()
    {
        return route('threads.show', [$this->category->slug, $this->id]);
    }

    public function createReply($reply)
    {
        $reply =  $this->replies()->create($reply);

        $this->subscribers
            ->where('id', '!==', $reply->user_id)
            ->each
            ->notify(new ThreadSubscription($this, $reply));

        return $reply;
    }

    public function subscribe()
    {
        return $this->subscribers()->attach(auth()->id());
    }

    public function unsubscribe()
    {
        return $this->subscribers()->detach(auth()->id());
    }

    public function scopeFilter(Builder $query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscribers()->wherePivot('user_id', auth()->id())->exists();
    }
}
