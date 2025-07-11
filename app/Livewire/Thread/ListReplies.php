<?php

namespace App\Livewire\Thread;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;

class ListReplies extends Component
{
    #[Locked]
    public int $threadId;

    #[Computed]
    public function thread(): Thread
    {
        return Thread::with('replies.user')->findOrFail($this->threadId);
    }

    #[On('replyCreated')]
    public function refreshReplies(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.thread.list-replies', [
            'replies' => $this->thread->replies,
        ]);
    }
}
