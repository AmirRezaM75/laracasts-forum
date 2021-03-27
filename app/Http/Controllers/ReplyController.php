<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use App\Rules\Spam;
use Illuminate\Http\Request;

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

    public function store(Request $request, Thread $thread)
    {
        $this->validate($request, ['body' => ['required', new Spam]]);

        $reply = $thread->createReply([
            'body' => $request->get('body'),
            'user_id' => auth()->id()
        ]);

        return response()->json($reply->load('user'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $this->validate($request, ['body' => ['required', new Spam]]);

        $reply->update(['body' => $request->get('body')]);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return response()->noContent();
    }
}
