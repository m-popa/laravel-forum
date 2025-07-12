<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Comment;

final class ToggleCommentVoteAction
{
    public function execute(Comment $comment, bool $isLiked, User $user): ?bool
    {
        $vote = $comment->votes()->firstWhere('user_id', $user->id);

        if ($vote) {
            if ($vote->isLiked() === $isLiked) {
                $vote->delete();
                return null;
            }

            $vote->update(['is_liked' => $isLiked]);
            return $isLiked;
        }

        $comment->votes()->create([
            'user_id' => $user->id,
            'is_liked' => $isLiked,
        ]);

        return $isLiked;
    }
}
