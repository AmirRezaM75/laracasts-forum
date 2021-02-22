<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
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


    /** @test */
    public function users_can_create_thread()
    {
        $this->actingAs(User::factory()->create());

        $thread = Thread::factory()->raw();

        $this->post(route('threads.store'), $thread);

        $this->get('threads')
            ->assertSee($thread['title'])
            ->assertSee($thread['body']);
    }

    /** @test */
    public function guest_can_not_create_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.store'), []);
    }
}
