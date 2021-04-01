<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cant_upload_avatar()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('users/1/avatar');
    }

    /** @test */
    public function users_must_provide_valid_avatar()
    {
        $this->login();

        $this->post('users/' . auth()->id() . '/avatar', ['avatar' => 'not-image'])
            ->assertSessionHasErrors('avatar');
    }


    /** @test */
    public function users_can_upload_avatar()
    {
        $this->login();

        Storage::fake();

        $this->post('users/' . auth()->id() . '/avatar', [
           'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertEquals($file->hashName(), auth()->user()->getRawOriginal('avatar'));

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}
