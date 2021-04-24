<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_screen_can_be_rendered()
    {
        $this->get('/register')->assertStatus(200);
    }

    /** @test */
    public function guests_can_register()
    {
        Notification::fake();

        $this->post('/register', User::factory()->raw(['password' => 'password']))
            ->assertRedirect(RouteServiceProvider::HOME);

        $this->assertAuthenticated();

        Notification::assertSentTo(auth()->user(), VerifyEmail::class);
    }

    /** @test */
    public function username_must_be_unique()
    {
        User::factory()->create(['username' => 'spatie']);

        $this->post('/register', User::factory()->raw(['username' => 'spatie']))
            ->assertSessionHasErrors('username');
    }

    /** @test */
    public function username_must_only_contains_characters_and_numbers()
    {
        # We do further checking on RegexTest.php
        $this->post('/register', User::factory()->raw(['username' => '@spatie']))
            ->assertSessionHasErrors('username');
    }

    /** @test */
    public function email_must_be_unique()
    {
        User::factory()->create(['email' => 'example@test.com']);

        $this->post('/register', User::factory()->raw(['email' => 'example@test.com']))
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid()
    {
        $this->post('/register', User::factory()->raw(['email' => 'example.com']))
            ->assertSessionHasErrors('email');
    }
}
