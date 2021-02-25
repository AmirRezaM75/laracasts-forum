<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(Request $request, Category $category)
    {
        if ($category->exists) {
            $threads = $category->threads()->latest();
        } else {
            $threads = Thread::latest();
        }

        if ($username = $request->get('by')) {
            $user = User::where('name', $username)->firstOrFail();

            $threads->where('user_id', $user->id);
        }

        return view('threads.index', ['threads' => $threads->get()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        return redirect($thread->path());
    }

    public function show(Category $category, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Thread $thread)
    {
        //
    }
}
