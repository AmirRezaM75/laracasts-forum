<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    protected $model = DatabaseNotification::class;

    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'type' => 'App\Notifications\ThreadSubscription',
            'notifiable_id' => function() {
                return auth()->id() ?? User::factory()->create();
            },
            'notifiable_type' => 'App\Models\User',
            'data' => ['message' => 'text']
        ];
    }
}
