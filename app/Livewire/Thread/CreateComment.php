<?php

namespace App\Livewire\Thread;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CreateComment extends Component
{
    public int    $threadId;
    public ?int   $parentId = null;
    public string $body     = '';

    public function create(): void
    {
        $this->validate([
            'body' => 'required|string|min:3',
        ]);

        Comment::create([
            'thread_id' => $this->threadId,
            'parent_id' => $this->parentId,
            'body' => $this->body,
            'user_id' => Auth::id(),
        ]);

        $this->reset('body');

        $this->dispatch('replyCreated');
    }
}

