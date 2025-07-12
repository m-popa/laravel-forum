<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Actions\ToggleCommentVoteAction;

class VoteButton extends Component
{
    public Comment $comment;

    public ?bool $userVote = null;

    public int $votesCount = 0; // NEW

    public function mount(): void
    {
        $vote           = $this->comment->votes->firstWhere('user_id', Auth::id());
        $this->userVote = $vote?->isLiked();

        $this->updateVotesCount();
    }

    protected function updateVotesCount(): void
    {
        $likes    = $this->comment->votes()->where('is_liked', true)->count();
        $dislikes = $this->comment->votes()->where('is_liked', false)->count();

        $this->votesCount = $likes - $dislikes;
    }

    public function vote(bool $isLiked, ToggleCommentVoteAction $action): void
    {
        $this->userVote = $action->execute($this->comment, $isLiked, Auth::user());
        $this->comment->refresh(); // Refresh model to get latest votes
        $this->updateVotesCount();
    }
}
