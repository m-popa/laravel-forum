<?php

namespace App\Livewire\Comment;

use App\Actions\ToggleCommentVoteAction;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VoteButton extends Component
{
    public Comment $comment;

    public ?bool $userVote = null;

    public int $votesCount = 0;

    public bool $isVoting = false;

    public function mount(): void
    {
        $vote = $this->comment->votes->firstWhere('user_id', Auth::id());
        $this->userVote = $vote?->isLiked();

        $this->updateVotesCount();
    }

    protected function updateVotesCount(): void
    {
        $likes = $this->comment->votes()->where('is_liked', true)->count();
        $dislikes = $this->comment->votes()->where('is_liked', false)->count();

        $this->votesCount = $likes - $dislikes;
    }

    public function vote(bool $isLiked, ToggleCommentVoteAction $action): void
    {
        if ($this->isVoting) {
            return;
        }

        $this->isVoting = true;

        $this->userVote = $action->execute($this->comment, $isLiked, Auth::user());
        $this->comment->refresh();
        $this->updateVotesCount();

        $this->isVoting = false;
    }
}
