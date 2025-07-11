<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;

class ThreadController extends Controller
{
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
