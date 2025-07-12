<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VoteButton extends Component
{
    public Comment $comment;

    public ?bool $userVote = null;

    public function mount(): void
    {
        $vote = $this->comment->votes->firstWhere('user_id', Auth::id());
        $this->userVote = $vote?->isLiked();
    }

    public function vote(bool $isLiked): void
    {
        $this->userVote = $this->comment->toggleVote($isLiked, Auth::user());
    }
}
