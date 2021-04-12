<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BestReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_mark_best_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(url('replies/1/best'));
    }


    /** @test */
    public function creator_may_mark_reply_as_answer()
    {
        $this->login();

        Thread::factory()
            ->has(Reply::factory(2), 'replies')
            ->create(['user_id' => auth()->id()]);

        $reply = Reply::find(1);

        $this->assertFalse($reply->isBest());

        $this->post(route('replies.best', $reply));

        $this->assertTrue($reply->fresh()->isBest());
    }

    /** @test */
    public function only_creator_may_mark_reply_as_answer()
    {
        $this->login();

        Thread::factory()
            ->has(Reply::factory(), 'replies')
            ->create(['user_id' => User::factory()->create()->id]);

        $this->post(url('replies/1/best'))
            ->assertStatus(403);

        $this->assertFalse(Reply::find(1)->isBest());
    }
}
