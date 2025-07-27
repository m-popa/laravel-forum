<?php

namespace App\Livewire\Comment;

use App\Actions\ToggleCommentVoteAction;
use App\Models\Comment;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VoteButton extends Component
{
    use WithRateLimiting;

    public Comment $comment;

    public ?bool $userVote = null;

    public int $votesCount = 0;

    public function mount(): void
    {
        $this->userVote = $this->comment->user_vote;
        $this->votesCount = $this->comment->votes_count;
    }

    public function vote(bool $isLiked, ToggleCommentVoteAction $action): void
    {
        try {
            $this->rateLimit(60);
        } catch (TooManyRequestsException) {
            Notification::make()
                ->danger()
                ->title('Too many requests')
                ->body('Please try again later.')
                ->send();

            return;
        }

        $this->userVote = $action->execute($this->comment, $isLiked, Auth::user());

        $this->comment->load('votes');

        $this->userVote = $this->comment->user_vote;
        $this->votesCount = $this->comment->votes_count;
    }
}
