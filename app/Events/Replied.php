<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class Replied
{
    use SerializesModels;

    public $reply;

    public function __construct($reply)
    {
        $this->reply = $reply;
    }
}
