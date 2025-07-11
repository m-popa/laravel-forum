<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\CommentVote;
use Illuminate\Support\Facades\Auth;

class CreateCommentVote extends Component
{
    public Comment $comment;
    public ?bool   $userVote = null;
    public int     $userId;

    public function mount(): void
    {
        $this->userId   = Auth::id();
        $this->userVote = $this->comment
            ->votes()
            ->where('user_id', $this->userId)
            ->value('is_liked');
    }

    public function vote(bool $isLiked): void
    {
        if ($this->userVote === $isLiked) {
            $this->comment->votes()
                          ->where('user_id', $this->userId)
                          ->delete();

            $this->userVote = null;
            return;
        }

        CommentVote::updateOrCreate(
            [
                'user_id' => $this->userId,
                'comment_id' => $this->comment->id,
            ],
            [
                'is_liked' => $isLiked,
            ]
        );

        $this->userVote = $isLiked;
    }

}
