<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThreadSubscription extends Notification
{
    use Queueable;

    private $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'username' => $this->reply->user->username,
            'title' => $this->reply->thread->title,
            'message' => 'replied to',
            'link' => $this->reply->path()
        ];
    }
}
