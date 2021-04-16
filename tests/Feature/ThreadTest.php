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
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function redirect_home_page_to_threads_index()
    {
        $this->get('/')->assertRedirect('/threads');
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
    public function guests_can_not_create_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectAuthException();

        $this->post(route('threads.store'), []);
    }

    /** @test */
    public function users_can_create_thread()
    {
        $this->login();

        $thread = Thread::factory()->raw(['user_id' => auth()->id()]);

        $this->post(route('threads.store'), $thread)
            ->assertJsonPath('redirect', url('/threads/' . Category::find(2)->slug . '/2'));

        $thread['body'] = "<p>{$thread['body']}</p>";

        $this->assertDatabaseHas('threads', $thread);
    }

    /** @test */
    public function users_can_update_thread()
    {
        $this->login();

        $thread = Thread::factory()->create(['user_id' => auth()->id()]);

        $data = [
            'title' => 'updated title',
            'body' => 'updated body',
            'category_id' => 1
        ];

        $this->patch(route('threads.update', $thread), $data)
            ->assertJsonPath('redirect', url('/threads/' . Category::find(1)->slug . '/2'));

        $data['body'] = "<p>{$data['body']}</p>";

        $this->assertDatabaseHas('threads', $data);
    }


    /** @test */
    public function guests_can_not_delete_thread()
    {
        $this->withoutExceptionHandling();

        $this->expectAuthException();

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

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread)
        ]);

        $this->assertDatabaseMissing('activities', [
            'subject_id' => $reply->id,
            'subject_type' => get_class($reply)
        ]);
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
    public function thread_requires_spam_free_body()
    {
        $this->publishThread(['body' => "This community is SHIT"])
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

    protected function publishThread($overrides)
    {
        $this->login();

        $thread = Thread::factory()->raw($overrides);

        return $this->post(route('threads.store'), $thread);
    }
}
