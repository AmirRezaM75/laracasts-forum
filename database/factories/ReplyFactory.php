<?php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'thread_id' => Thread::factory(),
            'parent_id' => null,
            'body' => $this->faker->paragraph
        ];
    }
}
