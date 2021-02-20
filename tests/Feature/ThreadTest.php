<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp(); // because we are extending Illuminate\Foundation\Testing\TestCase

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function users_can_see_threads()
    {
        $this->get('/threads')
            ->assertViewIs('threads.index')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function users_can_see_single_thread()
    {
        $this->get($this->thread->path())
            ->assertViewIs('threads.show')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function users_can_see_associated_replies()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

}
