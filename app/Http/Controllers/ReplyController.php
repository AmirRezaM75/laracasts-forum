<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $thread->addReply([
            'body' => $request->get('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
