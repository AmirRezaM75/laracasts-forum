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

        $this->expectAuthException();

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

    /** @test */
    function set_thread_answer_to_null_if_best_reply_is_deleted()
    {
        $this->markTestSkipped("SQLite doesn't support the ADD CONSTRAINT variant of the ALTER TABLE command");

        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $reply->thread->update(['answer_id' => $reply->id]);

        $this->delete(route('replies.destroy', $reply));

        $this->assertNull($reply->thread->fresh()->answer_id);
    }
}
