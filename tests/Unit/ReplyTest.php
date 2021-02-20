<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
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
}
