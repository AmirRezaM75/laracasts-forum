<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileSubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_view_notification_setting_page()
    {
        $this->get('profile/subscriptions')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function users_can_view_notification_setting_page()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $this->get('profile/subscriptions')
            ->assertViewIs('profiles.settings.subscriptions')
            ->assertViewHas('subscriptions');
    }

    /** @test */
    public function user_can_unsubscribe_from_a_thread()
    {
        $this->login();

        $threads = Thread::factory(2)->create();

        $threads->each->subscribe();

        $this->delete('threads/' . $threads[0]->id . '/subscriptions');

        $this->assertCount(1, auth()->user()->subscriptions);
    }

    /** @test */
    public function user_can_unsubscribe_from_all_thread()
    {
        $this->login();

        $threads = Thread::factory(2)->create();

        $threads->each->subscribe();

        $this->delete('profile/subscriptions');

        $this->assertCount(0, auth()->user()->fresh()->subscriptions);
    }
}
