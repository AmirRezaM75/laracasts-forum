<?php

namespace App\Providers;

use App\Events\Replied;
use App\Listeners\NotifyMentionedUsers;
use App\Listeners\NotifySubscribers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Replied::class => [
            NotifyMentionedUsers::class,
            NotifySubscribers::class
        ]
    ];
}
