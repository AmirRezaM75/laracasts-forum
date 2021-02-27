<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
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
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(10)
        ]);
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Thread $thread)
    {
        //
    }

    protected function getThreads(Category $category, ThreadFilters $filters)
    {
        $threads = Thread::with('category')->latest()->filter($filters);

        if ($category->exists) {
            $threads->where('category_id', $category->id);
        }

        return $threads->get();
    }
}
