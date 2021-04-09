<?php

namespace Tests\Feature;

use App\Utilities\Regex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function username_must_only_contains_characters_and_numbers()
    {
        $usernames = ['spatie/', 'spatie!', 'spatie*', '@spatie', '#spatie', '$spatie'];

        foreach ($usernames as $username) {
            $this->assertSame(0, preg_match(Regex::USERNAME, $username));
        }
    }
}
