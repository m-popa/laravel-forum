<?php

namespace App\Livewire\Thread;

use Livewire\Component;
use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class CreateComment extends Component
{
    #[Locked]
    public int $threadId;

    public ?int $parentId = null;

    #[Validate('required|string|min:3')]
    public string $body = '';


    #[Computed]
    public function parentUserName(): ?string
    {
        if (!$this->parentId) {
            return null;
        }

        $parentComment = Comment::find($this->parentId);

        return $parentComment?->user?->name;
    }

    #[On('reply-to-comment')]
    public function setParent(int $parentId): void
    {
        $this->parentId = $parentId;
    }

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

        $this->reset('body', 'parentId');

        $this->dispatch('replyCreated');
    }
}

