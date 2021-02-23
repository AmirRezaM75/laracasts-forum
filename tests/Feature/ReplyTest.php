<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_can_not_add_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = Thread::factory()->create();

        $this->post('threads/'. $thread->id .'/replies', []);
    }

    /** @test */
    public function auth_users_can_leave_a_reply()
    {
        $this->login();

        $reply = Reply::factory()->raw();

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply);

        $this->get($thread->path())
            ->assertSee($reply['body']);
    }

    /** @test */
    public function reply_requires_body()
    {
        $this->login();

        $reply = Reply::factory()->raw(['body' => null]);

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertSessionHasErrors('body');
    }
}
