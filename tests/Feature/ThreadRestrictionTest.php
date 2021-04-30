<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadRestrictionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_lock_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectAuthException();

        $this->post(url('threads/1/lock'));
    }

    /** @test */
    public function users_can_not_lock_thread()
    {
        $this->login();

        $thread = Thread::factory()->create();

        $this->post(route('threads.lock', $thread))
            ->assertStatus(302);

        $this->assertFalse($thread->fresh()->locked);
    }

    /** @test */
    public function users_can_not_unlock_thread()
    {
        $this->login();

        $thread = Thread::factory()->create(['locked' => true]);

        $this->delete(route('threads.lock', $thread))
            ->assertStatus(302);

        $this->assertTrue($thread->fresh()->locked);
    }

    /** @test */
    public function admin_can_lock_thread()
    {
        $this->login(User::factory()->admin()->create());

        $thread = Thread::factory()->create();

        $this->post(route('threads.lock', $thread));

        $this->assertTrue($thread->fresh()->locked);
    }

    /** @test */
    public function admin_can_unlock_thread()
    {
        $this->login(User::factory()->admin()->create());

        $thread = Thread::factory()->create(['locked' => true]);

        $this->delete(route('threads.lock', $thread));

        $this->assertFalse($thread->fresh()->locked);
    }

    /** @test */
    public function locked_thread_can_not_receive_new_reply()
    {
        $this->login();

        $thread = Thread::factory()->create(['locked' => true]);

        $this->post(route('threads.replies.store', $thread), ['body' => 'something'])
            ->assertStatus(403);

        $this->assertCount(0, $thread->fresh()->replies);
    }
}
