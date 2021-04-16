<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function guests_can_not_subscribe_to_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectAuthException();

        $this->post('/threads/1/subscriptions');
    }

    /** @test */
    public function users_can_subscribe_to_thread()
    {
        $this->login();

        $this->post('/threads/' . $this->thread->id . '/subscriptions');

        $this->assertCount(1, $this->thread->subscribers);
    }

    /** @test */
    public function users_can_unsubscribe_from_thread()
    {
        $this->login();

        $this->thread->subscribe();

        $this->delete('/threads/' . $this->thread->id . '/subscriptions');

        $this->assertCount(0, $this->thread->subscribers);
    }
}
