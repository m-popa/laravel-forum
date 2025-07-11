<?php

namespace App\Livewire\Thread;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;

class ListComments extends Component
{
    #[Locked]
    public int $threadId;

    #[Computed]
    public function thread(): Thread
    {
        return Thread::with('comments.user')->findOrFail($this->threadId);
    }

    #[On('replyCreated')]
    public function refreshReplies(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.thread.list-comments', [
            'comments' => $this->thread->comments,
        ]);
    }
}
