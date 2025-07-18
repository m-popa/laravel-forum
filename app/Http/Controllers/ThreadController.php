<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;
use App\Jobs\IncrementThreadViewsJob;

class ThreadController extends Controller
{

    public function index(Category $category)
    {
        $threads = $category->threads()
                            ->with('user')
                            ->latest()
                            ->paginate(10);

        return view('threads.index', [
            'threads' => $threads,
            'category' => $category,
        ]);
    }

    public function show(Category $category, Thread $thread)
    {
        IncrementThreadViewsJob::dispatch($thread);

        return view('threads.show', [
            'thread' => $thread,
            'category' => $category,
        ]);
    }

    public function create(Category $category)
    {
        return view('threads.create', [
            'category' => $category,
        ]);
    }
}
