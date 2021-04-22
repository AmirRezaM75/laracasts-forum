<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Thread;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Thread $thread)
    {
        return $thread->replies()->paginate(15);
    }

    public function store(ReplyRequest $request, Thread $thread)
    {
        return $thread->createReply([
            'body' => $request->get('body'),
            'user_id' => auth()->id(),
            'parent_id' => $request->get('parent_id')
        ])->load('user');
    }

    public function update(ReplyRequest $request, Reply $reply)
    {
        $reply->update(['body' => $request->get('body')]);

        return response()->json(['body' => $reply->body]);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return response()->noContent();
    }

    public function best(Reply $reply)
    {
        $this->authorize('update', $reply->thread);

        $reply->thread->update(['answer_id' => $reply->id]);

        $reply->activities()->create([
            'user_id' => $reply->user->id,
            'type' => 'awarded_best_reply'
        ]);
    }
}
