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

        $this->expectAuthException();

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

    /** @test */
    public function it_stripes_out_forbidden_tags()
    {
        $this->login();

        $response = $this->post('markdown', ['markdown' => "#heading <a href='#' onclick='alert()'>Danger</a>"]);

        $this->assertEquals('heading <a href="#">Danger</a>', $response->json());
    }
}
