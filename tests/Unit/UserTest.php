<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_fetch_last_reply()
    {
        $user = User::factory()->create();

        $reply = Reply::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($reply->id, $user->recentReply->id);
    }

    /** @test */
    public function user_can_detect_avatar_path()
    {
        $user = User::factory()->create();

        $this->assertEquals(asset('images/avatars/default-avatar-1.png'), $user->avatar);

        $user->avatar = 'example.jpg';

        $this->assertEquals(asset('storage/avatars/example.jpg'), $user->avatar);
    }

    /** @test */
    public function user_know_if_he_is_admin()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->isAdmin());

        $user = User::factory()->admin()->create();

        $this->assertTrue($user->isAdmin());
    }

    /** @test */
    public function it_casts_properties_to_array()
    {
        $user = User::factory()->create(['profile' => ['twitter' => 'twitter']]);

        $this->assertIsArray($user->profile);

        $this->assertEquals('twitter', $user->profile['twitter']);
    }

    /** @test */
    public function it_casts_visibility_status_to_boolean()
    {
        $user = User::factory()->create(['private' => '1']);

        $this->assertTrue($user->private);
    }
}
