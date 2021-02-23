<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function category_has_many_threads()
    {
        $category = Category::factory()->create();
        $thread = Thread::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($category->threads->contains($thread));
    }
}
