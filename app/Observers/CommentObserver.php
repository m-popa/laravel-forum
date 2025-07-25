<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        $comment->thread->update([
            'last_commented_at' => now(),
        ]);
    }
}
