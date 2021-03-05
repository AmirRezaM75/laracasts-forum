<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Fetch an activity feed for the given user.
     *
     * @param  User $user
     * @param  int  $take
     * @return \Illuminate\Database\Eloquent\Collection;
     */
    public static function feed(User $user, int $take = 30)
    {
        return $user
            ->activities()
            ->latest()
            ->take($take)
            ->with('subject')
            ->get()
            ->groupBy(function($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
