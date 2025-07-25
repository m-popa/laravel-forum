<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Actions\ToggleCommentVoteAction;
use Filament\Notifications\Notification;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class VoteButton extends Component
{
    use WithRateLimiting;

    public Comment $comment;

    public ?bool $userVote = null;

    public int $votesCount = 0;

    public function mount(): void
    {
        $this->userVote = $this->comment->votes
            ->firstWhere('user_id', Auth::id())?->isLiked();

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
        $this->updateVotesCount();
    }
}
