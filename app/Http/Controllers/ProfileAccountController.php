<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profiles.account');
    }

    public function update(Request $request)
    {
        auth()->user()->update([
            'properties' => $request->get('properties')
        ]);
    }
}
