<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'items' => Activity::feed($user)
        ]);
    }
}