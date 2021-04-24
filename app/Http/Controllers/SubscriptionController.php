<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('profiles.settings.subscriptions', [
            'subscriptions' => auth()->user()->subscriptions
        ]);
    }

    public function store(Thread $thread)
    {
        $thread->subscribe();
    }

    public function destroy(Thread $thread)
    {
        $thread->exists
            ? $thread->unsubscribe()
            : auth()->user()->subscriptions()->detach();

        return response()->noContent();
    }
}
