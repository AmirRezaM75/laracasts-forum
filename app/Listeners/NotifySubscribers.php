<?php

namespace App\Listeners;

use App\Events\Replied;
use App\Notifications\ThreadSubscription;

class NotifySubscribers
{
    public function handle(Replied $event)
    {
        $event->reply->thread->subscribers
            ->where('id', '!==', $event->reply->user_id)
            ->each
            ->notify(new ThreadSubscription($event->reply));
    }
}
