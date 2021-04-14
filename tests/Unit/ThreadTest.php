<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use App\Notifications\ThreadSubscription;
use App\Utilities\Trending;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    protected $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function thread_has_replies()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->thread->replies);
    }

    /** @test */
    public function thread_has_user()
    {
        $this->assertInstanceOf(User::class, $this->thread->user);
    }

    /** @test */
    public function thread_can_add_reply()
    {
        $this->thread->createReply(Reply::factory()->raw());

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function thread_notifies_subscribers_when_receives_new_reply()
    {
        Notification::fake();

        $this->login();

        $this->thread->subscribe();

        $this->thread->createReply(Reply::factory()->raw());

        Notification::assertSentTo(auth()->user(), ThreadSubscription::class);
    }

    /** @test */
    public function thread_belongs_to_category()
    {
        $this->assertInstanceOf(Category::class, $this->thread->category);
    }

    /** @test */
    public function thread_can_make_path()
    {
        $this->assertEquals(
            url("/threads/{$this->thread->category->slug}/{$this->thread->id}"),
            $this->thread->path()
        );
    }

    /** @test */
    public function users_can_subscribe_to_thread()
    {
        $this->login();

        $this->thread->subscribe();

        $this->assertEquals(1, $this->thread->subscribers->count());
    }

    /** @test */
    public function users_can_unsubscribe_from_thread()
    {
        $this->login();

        $this->thread->subscribe();

        $this->thread->unsubscribe();

        $this->assertEquals(0, $this->thread->subscribers->count());
    }

    /** @test */
    public function it_appends_user_subscription_status()
    {
        $this->login();

        $this->assertFalse($this->thread->isSubscribedTo);

        $this->thread->subscribe();

        $this->assertTrue($this->thread->isSubscribedTo);
    }

    /** @test */
    public function thread_is_updated_since_user_read_it()
    {
        $this->assertFalse($this->thread->hasUpdates());

        $this->login();

        $this->assertFalse($this->thread->hasUpdates());

        auth()->user()->read($this->thread);

        Carbon::setTestNow(Carbon::now()->addMinute());

        $this->thread->createReply(Reply::factory()->raw());

        $this->assertTrue($this->thread->hasUpdates());
    }

    /** @test */
    public function thread_knows_about_number_of_visits()
    {
        Trending::flush();

        $this->assertEquals(0, $this->thread->visits);

        Trending::push($this->thread->id);

        $this->assertEquals(1, $this->thread->visits);
    }

    /** @test */
    public function it_wraps_mentioned_usernames_within_anchor_tags()
    {
        $thread = Thread::factory()->make([
            'body' => "Hello, <a href='/@jeffrey'>@jeffrey</a> and @spatie."
        ]);

        $this->assertEquals(
            "<p>Hello, <a href='/@jeffrey'>@jeffrey</a> and <a href='/@spatie'>@spatie</a>.</p>",
            $thread->body);
    }

    /** @test */
    public function thread_knows_if_it_is_solved()
    {
        $this->assertFalse($this->thread->isSolved());

        $thread = Thread::factory()->solved()->create();

        $this->assertTrue($thread->isSolved());
    }
}
