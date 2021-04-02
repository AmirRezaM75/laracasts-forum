<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use PHPUnit\Framework\TestCase;

class SpamTest extends TestCase
{
    private $spam;

    protected function setUp(): void
    {
        parent::setUp();

        $this->spam = new Spam;
    }

    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        $this->assertFalse($this->spam->detect('Normal reply'));

        $this->assertTrue($this->spam->detect('Hey, Idiot'));
    }

    /** @test */
    function it_checks_for_any_key_being_held_down()
    {
        $this->assertTrue($this->spam->detect('Hello world aaaaaaaaa'));
        $this->assertFalse($this->spam->detect('       <p>Ignore Indentation</p>'));
    }
}
