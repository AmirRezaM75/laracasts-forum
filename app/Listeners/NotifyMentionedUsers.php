<?php

namespace App\Listeners;

use App\Events\Replied;
use App\Models\User;
use App\Notifications\UserMention;

class NotifyMentionedUsers
{
    public function handle(Replied $event)
    {
        User::whereIn('name', $event->reply->mentionedUsers())
            ->get()
            ->each
            ->notify(new UserMention($event->reply));
    }
}
