<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CreateCommentVote extends Component
{
    public Comment $comment;
    public ?bool   $userVote = null;

    public function mount(): void
    {
        $this->userVote = $this->comment->votes->first()?->is_liked;
    }

    public function vote(bool $isLiked): void
    {
        $this->userVote = $this->comment->toggleVote($isLiked, Auth::user());
    }
}
