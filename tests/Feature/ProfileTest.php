<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
}
