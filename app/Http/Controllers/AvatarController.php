<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        auth()->user()->update([
            'avatar' => str_replace('avatars/', '', $path)
        ]);
    }
}
