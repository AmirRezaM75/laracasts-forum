<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserMention extends Notification
{
    use Queueable;

    protected $reply;

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
            'message' => 'mentioned you in',
            'link' => $this->reply->path()
        ];
    }
}
