<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Auth\Notifications\VerifyEmail;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_profile_page()
    {
        $user = User::factory()->create(['username' => 'spatie']);

        $this->get('/@spatie')
            ->assertViewIs('profiles.show')
            ->assertViewHas('user', $user);
    }

    /** @test */
    public function it_does_not_render_private_profiles()
    {
        User::factory()->create(['username' => 'spatie', 'private' => true]);

        $this->get('/@spatie')->assertStatus(404);
    }

    /** @test */
    public function guests_cant_access_profile_account_page()
    {
        $this->get('profile/account')->assertRedirect('/login');
    }

    /** @test */
    public function users_can_access_profile_account_page()
    {
        $this->login();

        $this->get('profile/account')
            ->assertStatus(200)
            ->assertViewIs('profiles.settings.account');
    }

    /** @test */
    public function users_can_update_their_profile_account()
    {
        $this->login();

        $data['profile'] = [
            'website' => 'www.example.com',
            'twitter' => 'twitter',
            'github' => 'github',
            'job' => 'developer',
            'hometown' => 'Tehran'
        ];

        $this->patch('profile/account', $data);

        $this->assertEquals(auth()->user()->fresh()->profile, $data['profile']);
    }

    /** @test */
    public function guests_can_not_update_profile()
    {
        $this->withoutExceptionHandling();

        $this->expectAuthException();

        $this->patch('profile', []);
    }

    /** @test */
    public function users_can_update_their_profile()
    {
        $this->login();

        $this->updateProfile();

        $this->assertEquals('spatie', auth()->user()->username);
        $this->assertEquals('example@test.com', auth()->user()->email);
        $this->assertEquals(true, auth()->user()->private);
    }

    /** @test */
    public function username_must_be_unique()
    {
        $this->login();

        User::factory()->create(['username' => 'spatie']);

        $this->patch('profile', ['username' => 'spatie', 'email' => 'example@test.com'])
            ->assertSessionHasErrors('username');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $this->login();

        User::factory()->create(['email' => 'example@test.com']);

        $this->patch('profile', ['username' => 'spatie', 'email' => 'example@test.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function uniqueness_of_current_email_will_be_ignored()
    {
        $this->login(User::factory()->create(['email' => 'example@test.com']));

        $this->patch('profile', ['username' => 'spatie', 'email' => 'example@test.com']);

        $this->assertEquals('example@test.com', auth()->user()->email);
    }

    /** @test */
    public function send_new_email_verification_if_users_update_their_email()
    {
        Notification::fake();

        $this->login();

        $this->patch('profile', ['username' => 'spatie', 'email' => 'example@test.com']);

        Notification::assertSentTo(auth()->user(), VerifyEmail::class);

        $this->assertNull(auth()->user()->email_verified_at);
    }

    /** @test */
    public function users_can_update_their_password()
    {
        $this->login();

        $this->patch('profile', [
            'username' => 'spatie',
            'email' => 'example@test.com',
            'password' => 'new-password'
        ]);

        $this->assertTrue(Hash::check('new-password', auth()->user()->password));
    }

    private function updateProfile() {
        return $this->patch('profile', [
            'username' => 'spatie',
            'email' => 'example@test.com',
            'private' => true
        ]);
    }
}
