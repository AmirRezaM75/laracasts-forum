<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'items' => $this->getActivities($user)
        ]);
    }

    protected function getActivities(User $user)
    {
        return $user->activities()->latest()->with('subject')->get()->groupBy(function($activity) {
            return $activity->created_at->format('Y-m-d');
        });
    }
}
