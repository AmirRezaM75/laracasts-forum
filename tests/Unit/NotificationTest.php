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

        $thread->createReply(['user_id' => auth()->id(), 'body' => 'message']);

        $this->assertCount(0, auth()->user()->notifications);

        $user = User::factory()->create();

        $reply = $thread->createReply(['user_id' => $user->id, 'body' => 'message']);

        $notifications = auth()->user()->fresh()->notifications;

        $this->assertCount(1, $notifications);

        $this->assertEquals('replied to', $notifications->first()->data['message']);
        $this->assertEquals($user->username, $notifications->first()->data['username']);
        $this->assertEquals($thread->title, $notifications->first()->data['title']);
        $this->assertEquals($reply->path(), $notifications->first()->data['link']);
    }
}
