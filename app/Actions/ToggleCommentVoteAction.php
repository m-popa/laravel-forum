<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Comment;
use App\Models\User;

final class ToggleCommentVoteAction
{
    public function execute(Comment $comment, bool $isLiked, User $user): ?bool
    {
        $vote = $comment->votes->firstWhere('user_id', $user->id);

        if ($vote) {
            return $vote->toggle($isLiked);
        }

        $comment->vote($user, $isLiked);

        return $isLiked;
    }
}
