<?php

namespace App\Livewire\Thread;

use App\Actions\CreateCommentAction;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateComment extends Component
{
    #[Locked]
    public int $threadId;

    public ?int $parentId = null;

    #[Validate('required|string|min:3')]
    public string $body = '';

    #[Computed]
    public function parentPreview(): ?array
    {
        if (is_null($this->parentId)) {
            return null;
        }

        $parentComment = Comment::find($this->parentId);

        if (! $parentComment) {
            return null;
        }

        return [
            'name' => $parentComment->user->name,
            'preview' => str($parentComment->body)->limit(120),
        ];
    }

    #[On('reply-to-comment')]
    public function setParent(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function create(CreateCommentAction $action): void
    {
        $this->validate();

        $action->execute([
            'thread_id' => $this->threadId,
            'parent_id' => $this->parentId,
            'body' => $this->body,
        ], Auth::user());

        $this->reset('body', 'parentId');

        $this->dispatch('replyCreated');
    }
}
