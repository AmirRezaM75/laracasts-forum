<?php

namespace App\Models;

use App\Traits\HasActivity;
use App\Traits\HasFavorite;
use App\Utilities\Markdown;
use App\Utilities\Regex;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory, HasFavorite, HasActivity;

    protected $guarded = [];

    protected $with = ['user', 'favorites'];

    protected $appends = ['isFavorited', 'favoritesCount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function setBodyAttribute($body)
    {
        $this->attributes['body'] =
            preg_replace(
                Regex::USER_MENTION,
                "<a href='#'>$0</a>", Markdown::parse($body)
            );
    }

    public function path()
    {
        return $this->thread->path() . '#reply-' . $this->id;
    }

    public function wasRecentlyCreated()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    public function mentionedUsers()
    {
        preg_match_all(Regex::USER_MENTION, $this->body, $matches);

        return $matches[1];
    }
}
