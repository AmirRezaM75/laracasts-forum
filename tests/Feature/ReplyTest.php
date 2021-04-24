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

        $this->expectAuthException();

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

        $this->expectAuthException();

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

        $this->expectAuthException();

        $this->delete('replies/1', []);
    }

    /** @test */
    public function unauthorized_users_can_not_delete_reply()
    {
        $this->login();

        $reply = Reply::factory()->create();

        $this->delete(route('replies.destroy', $reply->id))
            ->assertStatus(403);
    }

    /** @test */
    public function users_can_delete_reply()
    {
        $this->login();

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $this->delete(route('replies.destroy', $reply->id))
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

        Notification::assertSentTo($user, UserMention::class, function($notification) use ($thread) {
            $data  = $notification->toArray(null);
            return $data['username'] === auth()->user()->username
                && $data['title'] === $thread->title
                && $data['message'] === 'mentioned you in'
                && ! empty($data['link']);
        });
    }

    /** @test */
    public function users_can_answer_a_reply()
    {
        $this->login();

        $reply = Reply::factory()->create();

        $answer = Reply::factory()->raw(['parent_id' => $reply->id]);

        $thread = Thread::factory()->create();

        $this->post(route('threads.replies.store', $thread), $answer);

        $this->assertCount(1, $reply->responses);
    }

    /** @test */
    public function users_can_get_list_of_thread_replies()
    {
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        Reply::factory(2)->create([
            'parent_id' => $reply->id,
            'thread_id' => $thread->id
        ]);

        $response = $this->getJson(route('threads.replies.index', $thread))->json();

        $this->assertCount(1, $response['replies']['data']);
        $this->assertEquals(3, $response['replies_count']);
    }
}
