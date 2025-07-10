<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'thread_id' => 'required|exists:threads,id',
            'parent_id' => 'nullable|exists:replies,id',
            'body'      => 'required|string|max:10000',
        ]);

        Reply::create([
            'thread_id' => $validated['thread_id'],
            'parent_id' => $validated['parent_id'] ?? null,
            'user_id'   => Auth::id(),
            'body'      => $validated['body'],
        ]);

        return redirect()->back()->with('success', 'Reply posted.');
    }
}
