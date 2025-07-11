<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $threads = $category->threads()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('categories.show', [
            'threads' => $threads,
            'category' => $category,
        ]);
    }
}
