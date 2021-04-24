<?php

namespace Tests\Feature;

use Database\Factories\NotificationFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->login();

        NotificationFactory::new()->create();
    }

    /** @test */
    public function users_can_fetch_unread_notifications()
    {
        $this->assertCount(1, $this->getJson('users/notifications')->json());
    }

    /** @test */
    public function users_can_mark_notification_as_read()
    {
        tap(auth()->user(), function($user) {
            $this->assertCount(1, $user->unreadNotifications);

            $this->delete('/users/notifications/' . $user->unreadNotifications->first()->id);

            $this->assertCount(0, $user->fresh()->unreadNotifications);
        });
    }

    /** @test */
    public function users_can_mark_all_notifications_as_read()
    {
        $this->withoutExceptionHandling();
        NotificationFactory::new()->create();

        tap(auth()->user(), function($user) {
            $this->assertCount(2, $user->unreadNotifications);

            $this->delete('/users/notifications');

            $this->assertCount(0, $user->fresh()->unreadNotifications);
            $this->assertCount(0, $user->fresh()->notifications);
        });
    }
}
