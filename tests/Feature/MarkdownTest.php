<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarkdownTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cant_parses_markdown()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('markdown');
    }

    /** @test */
    public function users_can_parse_markdown_to_html()
    {
        $this->login();

        $response = $this->post('markdown', [
            'markdown' => "``` public function test() {} ```"
        ]);

        $this->assertEquals("<p><code>public function test() {}</code></p>", $response->json());
    }
}
