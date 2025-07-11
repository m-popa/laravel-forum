<?php

namespace App\Livewire\Thread;

use App\Models\Thread;
use Livewire\Component;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CreateReply extends Component
{
    #[Locked]
    public int $threadId;

    #[Validate('required|string|min:3')]
    public string $body;

    #[Computed]
    public function thread(): Thread
    {
        return Thread::with('replies.user')->findOrFail($this->threadId);
    }

    public function create(): void
    {
        $this->validate();

        $this->thread->replies()->create([
            'body'    => $this->body,
            'user_id' => Auth::id(),
        ]);

        $this->reset('body');

        $this->dispatch('replyCreated');
    }
}
