<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp(); // because we are extending Illuminate\Foundation\Testing\TestCase

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function users_can_see_threads()
    {
        $this->get('/threads')
            ->assertViewIs('threads.index')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function users_can_see_single_thread()
    {
        $this->get($this->thread->path())
            ->assertViewIs('threads.show')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function users_can_see_associated_replies()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function guests_can_not_create_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post(route('threads.store'), []);
    }


    /** @test */
    public function users_can_create_thread()
    {
        $this->login();

        $thread = Thread::factory()->raw();

        $response = $this->post(route('threads.store'), $thread);

        $this->get($response->headers->get('Location'))
            ->assertSee($thread['title'])
            ->assertSee($thread['body']);
    }

    /** @test */
    public function guests_can_not_delete_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->delete(route('threads.destroy', 1), []);
    }

    /** @test */
    public function users_cant_delete_other_people_thread()
    {
        $this->login();

        $this->json('DELETE', route('threads.destroy', $this->thread->id))
            ->assertStatus(403);
    }

    /** @test */
    public function users_can_delete_thread()
    {
        $this->login();

        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->json('DELETE', route('threads.destroy', $thread->id))
            ->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function thread_requires_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function thread_requires_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function thread_requires_category()
    {
        $this->publishThread(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->publishThread(['category_id' => 999])
            ->assertSessionHasErrors('category_id');
    }

    /** @test */
    public function filter_threads_by_category()
    {
        $category = Category::factory()->create();
        $threadInCategory = Thread::factory()->create(['category_id' => $category->id]);
        $randomThread = Thread::factory()->create();

        $this->get("threads/{$category->slug}")
            ->assertSee($threadInCategory->title)
            ->assertDontSee($randomThread->title);
    }

    /** @test */
    public function filter_threads_by_user()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create(['user_id' => $user->id]);

        $this->get('threads?by=' . $user->name)
            ->assertSee($thread->title)
            ->assertDontSee($this->thread->title);
    }

    /** @test */
    public function filter_threads_by_popularity()
    {
        Thread::factory()
            ->has(Reply::factory()->count(3))
            ->create();

        Thread::factory()
            ->has(Reply::factory()->count(2))
            ->create();

        // Notice: We are creating a thread with no reply before each test.

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }

    protected function publishThread($overrides)
    {
        $this->login();

        $thread = Thread::factory()->raw($overrides);

        return $this->post(route('threads.store'), $thread);
    }
}
