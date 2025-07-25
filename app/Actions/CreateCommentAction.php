<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Comment;
use App\Data\CommentData;

final class CreateCommentAction
{
    public function execute(User $user, CommentData $data): Comment
    {
        return Comment::create([
            'thread_id' => $data->thread_id,
            'body' => $data->body,
            'parent_id' => $data->parent_id,
            'user_id' => $user->id,
        ]);
    }
}
