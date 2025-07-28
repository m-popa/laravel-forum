<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Category;

class ThreadController extends Controller
{
    public function index(Category $category)
    {
        $threads = $category->threads()
                            ->with(['user', 'user.media'])
                            ->orderBy('last_commented_at', 'desc')
                            ->paginate(10);

        return view('threads.index', [
            'threads' => $threads,
            'category' => $category,
            'categories' => Category::cachedCategories()->take(5),
        ]);
    }

    public function show(Category $category, Thread $thread)
    {
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
