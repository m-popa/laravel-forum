<?php

namespace App\Livewire\Comment;

use Livewire\Component;
use App\Models\Comment;

class CommentCard extends Component
{
    public Comment $comment;

    public function replyToComment(): void
    {
        $this->dispatch('reply-to-comment', parentId: $this->comment->id);
    }
}
