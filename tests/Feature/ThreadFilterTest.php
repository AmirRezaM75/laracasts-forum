<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadFilterTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }

    /** @test */
    public function filter_threads_by_category()
    {
        $category = Category::factory()->create();
        $thread = Thread::factory()->create(['category_id' => $category->id]);

        $this->get("threads/{$category->slug}")
            ->assertSee($thread->title)
            ->assertDontSee($this->thread->title);
    }

    /** @test */
    public function filter_threads_by_user()
    {
        $user = User::factory()->create();
        $thread = Thread::factory()->create(['user_id' => $user->id]);

        $this->get('threads?by=' . $user->username)
            ->assertSee($thread->title)
            ->assertDontSee($this->thread->title);
    }

    /** @test */
    public function filter_threads_by_popularity()
    {
        Thread::factory()
            ->has(Reply::factory(3))
            ->create();

        Thread::factory()
            ->has(Reply::factory(2))
            ->create();

        // Notice: We are creating a thread with no reply before each test.

        $response = $this->getJson('threads?popular=1')->json();

        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
    }

    /** @test */
    public function filter_threads_with_no_replies()
    {
        Thread::factory()
            ->has(Reply::factory(3))
            ->create();

        $response = $this->getJson('/threads?fresh=1')->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function filter_solved_threads()
    {
        Thread::factory()->solved()->create();

        $response = $this->getJson('/threads?answered=1')->json();

        $this->assertCount(1, $response['data']);

        $this->assertEquals(3, $response['data'][0]['id']);
    }

    /** @test */
    public function filter_unsolved_threads()
    {
        Thread::factory()->solved()->create();

        $response = $this->getJson('/threads?answered=0')->json();

        $this->assertCount(2, $response['data']);

        $this->assertEquals([1, 2], array_column($response['data'], 'id'));
    }

    /** @test */
    public function filter_threads_by_visits()
    {
        $this->markTestSkipped("FIELD is not available in SQLITE");

        $this->thread->visited(2);

        Thread::factory()->create()->visited(3);

        Thread::factory()->create()->visited(1);

        $response = $this->getJson('threads?trending=1')->json();

        $this->assertEquals([2, 1, 3], array_column($response['data'], 'id'));
    }

    /** @test */
    public function filter_threads_by_query()
    {
        Thread::factory()->create(['title' => 'Laravel Framework']);
        Thread::factory()->create(['title' => 'Unit testing in laravel']);
        Thread::factory()->create();

        $response = $this->getJson('threads?q=laravel')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals('Laravel Framework', $response['data'][0]['title']);
    }
}
