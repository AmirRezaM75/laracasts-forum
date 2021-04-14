<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'answer_id' => null,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph,
            'locked' => false
        ];
    }

    public function solved()
    {
        return $this->state(function(array $attributes) {
            return [
                'answer_id' => Reply::factory()
            ];
        });
    }
}
