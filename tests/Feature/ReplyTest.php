<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use App\Notifications\UserMention;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_add_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('threads/1/replies', []);
    }

    /** @test */
    public function users_can_leave_a_reply()
    {
        $this->login();

        $reply = Reply::factory()->raw();

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertJsonPath('user.id', auth()->id());

        $this->assertCount(1, $thread->replies);
    }

    /** @test */
    public function users_cant_reply_more_than_once_per_minute()
    {
        $this->login();

        $reply = Reply::factory()->raw();

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertStatus(Response::HTTP_CREATED);

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertStatus(Response::HTTP_FORBIDDEN);
//             ->assertStatus(Response::HTTP_TOO_MANY_REQUESTS); // TODO: send custom code

        Carbon::setTestNow(Carbon::now()->addMinutes(10));

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertStatus(Response::HTTP_CREATED);
    }

    /** @test */
    public function reply_requires_body()
    {
        $this->login();

        $reply = Reply::factory()->raw(['body' => null]);

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function reply_requires_spam_free_body()
    {
        $this->login();

        $reply = Reply::factory()->raw(['body' => "Idiots' question"]);

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $reply)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthenticated_users_can_not_update_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->patch('replies/1', []);
    }

    /** @test */
    public function unauthorized_users_can_not_update_reply()
    {
        $this->login();

        $reply = Reply::factory()->create();

        $this->patch(route('replies.update', $reply->id))
            ->assertStatus(403);
    }

    /** @test */
    public function users_can_update_reply()
    {
        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $body = 'update body';

        $this->patch(route('replies.update', $reply->id), ['body' => $body]);

        $this->assertEquals("<p>{$body}</p>", $reply->fresh()->body);
    }

    /** @test */
    public function reply_requires_body_on_update()
    {
        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $this->patch(route('replies.update', $reply->id), ['body' => ''])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function reply_requires_spam_free_body_on_update()
    {
        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $this->patch(route('replies.update', $reply->id), ['body' => 'Shit!'])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauthenticated_users_can_not_delete_reply()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->delete('replies/1', []);
    }

    /** @test */
    public function unauthorized_users_can_not_delete_reply()
    {
        $this->login();

        $reply = Reply::factory()->create();

        $this->delete(route('replies.delete', $reply->id))
            ->assertStatus(403);
    }

    /** @test */
    public function users_can_delete_reply()
    {
        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $this->delete(route('replies.delete', $reply->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function mentioned_users_in_reply_are_notified()
    {
        Notification::fake();

        $this->login();

        $user = User::factory()->create(['username' => 'spatie']);

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->raw(['body' => 'Hey, @spatie']);

        $this->post(route('threads.replies.store', $thread), $reply);

        Notification::assertSentTo($user, UserMention::class);
    }
}
