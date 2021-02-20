<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_see_threads()
    {
        $thread = Thread::factory()->create();

        $this->get('/threads')
            ->assertViewIs('threads.index')
            ->assertSee($thread->title);
    }

    /** @test */
    public function users_can_see_single_thread()
    {
        $thread = Thread::factory()->create();

        $this->get('/threads/' . $thread->id)
            ->assertViewIs('threads.show')
            ->assertSee($thread->title);
    }

}
