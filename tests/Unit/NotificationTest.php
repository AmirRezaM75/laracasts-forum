<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_notification_when_subscribed_thread_receive_new_reply_from_someone_else()
    {
        $this->login();

        $thread = Thread::factory()->create();

        $thread->subscribe();

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'message'
        ]);

        $this->assertCount(0, auth()->user()->notifications);


        $reply = $thread->addReply([
            'user_id' => User::factory()->create()->id,
            'body' => 'message'
        ]);

        $notifications = auth()->user()->fresh()->notifications;

        $this->assertCount(1, $notifications);

        $this->assertNotEmpty($notifications->first()->data['message']);

        $this->assertEquals($reply->path(), $notifications->first()->data['link']);
    }
}
