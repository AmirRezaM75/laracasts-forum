<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Http\Requests\ThreadRequest;
use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(Request $request, Category $category, ThreadFilters $filters)
    {
        $threads = $this->getThreads($category, $filters);

        if ($request->wantsJson())
            return $threads;

        return view('threads.index', compact('threads'));
    }

    public function store(ThreadRequest $request)
    {
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        return redirect($thread->path())->with('flash', 'Your thread has been published.');
    }

    public function show($categoryId, Thread $thread)
    {
        if (auth()->check())
            auth()->user()->read($thread);

        return view('threads.show', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if ($request->wantsJson())
            return response()->noContent();
    }

    protected function getThreads(Category $category, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($category->exists) {
            $threads->where('category_id', $category->id);
        }

        return $threads->get();
    }
}
