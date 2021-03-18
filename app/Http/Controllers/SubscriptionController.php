<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread)
    {
        $thread->subscribe();
    }

    public function destroy(Thread $thread)
    {
        $thread->unsubscribe();
    }
}
