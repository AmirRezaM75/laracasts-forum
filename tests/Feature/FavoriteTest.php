<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cant_favorite_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/replies/1/favorites');
    }

    /** @test */
    public function users_can_favorite_reply()
    {
        $this->login();

        $reply = Reply::factory()->create();

        $this->post('/replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function user_must_only_favorite_reply_once()
    {
        $this->withoutExceptionHandling();

        $this->login();

        $reply = Reply::factory()->create();

        try {
            $this->post('/replies/' . $reply->id . '/favorites');
            $this->post('/replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect the same record set twice.');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
