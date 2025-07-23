<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Comment;

final class ToggleCommentVoteAction
{
    public function execute(Comment $comment, bool $isLiked, User $user): ?bool
    {
        $vote = $comment->votes->firstWhere('user_id', $user->id);

        if (!$vote) {
            $comment->vote($user, $isLiked);
            return $isLiked;
        }

        return $vote->toggle($isLiked);
    }
}
