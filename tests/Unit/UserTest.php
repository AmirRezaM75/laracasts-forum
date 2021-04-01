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

        $this->assertEquals(asset('avatars/example.jpg'), $user->avatar);
    }
}
