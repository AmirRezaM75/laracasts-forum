<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function email_can_be_verified()
    {
        Event::fake();

        $user = User::factory()->unverified()->create();
        
        $this->login($user);

        $this->get(
            URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(30),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            )
        );

        Event::assertDispatched(Verified::class);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    /** @test */
    public function email_can_not_be_verified_with_invalid_hash()
    {
        $user = User::factory()->unverified()->create();

        $this->login($user);

        $this->get(
            URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(30),
                ['id' => $user->id, 'hash' => sha1('wrong-email')]
            )
        );

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
