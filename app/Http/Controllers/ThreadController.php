<?php

namespace App\Http\Controllers;

use App\Filters\ThreadFilters;
use App\Http\Requests\ThreadRequest;
use App\Models\Category;
use App\Models\Thread;
use App\Utilities\Trending;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
        $this->middleware('auth.admin')->only('lock');
    }

    public function index(Request $request, Category $category, ThreadFilters $filters)
    {
        $threads = $request->has('q')
            ? Thread::search($request->get('q'))->paginate(15)
            : $this->getThreads($category, $filters);

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

        return response()->json(['redirect' => $thread->path()]);
    }

    public function show($categoryId, Thread $thread)
    {
        if (auth()->check())
            auth()->user()->read($thread);

        Trending::push($thread->id);

        return view('threads.show', [
            'participatorsCount' => $thread->replies()->distinct()->count('user_id'),
            'thread' => $thread
        ]);
    }

    public function update(Request $request, Thread $thread)
    {
        $thread->update($request->only(['title', 'body', 'category_id']));

        return response()->json(
            array_merge(
                $thread->wasChanged('category_id') ? ['redirect' => $thread->fresh()->path()] : [],
                ['thread' => $thread->only(['title', 'body'])]
            )
        );
    }

    public function destroy(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if ($request->wantsJson())
            return response()->noContent();
    }

    public function lock(Thread $thread)
    {
        $thread->update(['locked' => true]);
    }

    public function unlock(Thread $thread)
    {
        $thread->update(['locked' => false]);
    }

    protected function getThreads(Category $category, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($category->exists)
            $threads->where('category_id', $category->id);

        return $threads->paginate(15);
    }
}
