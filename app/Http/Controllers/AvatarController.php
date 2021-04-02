<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate(['avatar' => 'required|image']);

        $path = $request->file('avatar')->store('avatars', 'public');

        $this->destroy();
        
        auth()->user()->update([
            'avatar' => str_replace('avatars/', '', $path)
        ]);
    }

    public function destroy()
    {
        if (! is_null($avatar = auth()->user()->getRawOriginal('avatar'))) {
            Storage::disk('public')->delete('avatars/' . $avatar);
        }
    }
}
