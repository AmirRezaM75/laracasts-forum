<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reply_has_user()
    {
        $reply = Reply::factory()->create();

        $this->assertInstanceOf(User::class, $reply->user);
    }

    /** @test */
    public function reply_knows_if_it_was_recently_created()
    {
        $reply = Reply::factory()->create();

        $this->assertTrue($reply->wasRecentlyCreated());

        $reply->created_at = Carbon::now()->subWeek();

        $this->assertFalse($reply->wasRecentlyCreated());
    }

    /** @test */
    public function reply_knows_about_mentioned_users()
    {
        $reply = Reply::factory()->make([
            'body' => 'Hello, @jeffreyway and @spatie'
        ]);

        $this->assertEquals(['jeffreyway', 'spatie'], $reply->mentionedUsers());
    }
}
