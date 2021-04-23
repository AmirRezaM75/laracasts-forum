<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        $reply = Reply::factory()->make(['body' => 'Hello @jeffrey, and @spatie.']);

        $this->assertEquals(['jeffrey', 'spatie'], $reply->mentionedUsers());
    }

    /** @test */
    public function it_wraps_mentioned_usernames_within_anchor_tags()
    {
        $reply = Reply::factory()->make([
            'body' => "Hello, <a href='/@jeffrey'>@jeffrey</a> and @spatie."
        ]);

        $this->assertEquals(
            '<p>Hello, <a href="/@jeffrey">@jeffrey</a> and <a href="/@spatie">@spatie</a>.</p>',
            $reply->body
        );
    }

    /** @test */
    public function it_parses_markdown_to_html()
    {
        $reply = Reply::factory()->make(['body' => 'Hello _Laravel_']);

        $this->assertEquals("<p>Hello <em>Laravel</em></p>", $reply->body);
    }

    /** @test */
    public function it_knows_if_it_is_the_best_reply()
    {
        $reply = Reply::factory()->create();

        $this->assertFalse($reply->isBest());

        $reply->thread->update(['answer_id' => $reply->id]);

        $this->assertTrue($reply->isBest());
    }

    /** @test */
    public function reply_may_have_answers()
    {
        $reply = Reply::factory()->create();

        $answer = Reply::factory()->create(['parent_id' => $reply->id]);

        $this->assertTrue($reply->responses->contains($answer));

        $this->assertInstanceOf(Collection::class, $reply->responses);
    }
}
