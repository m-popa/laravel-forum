<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Comment;

final class CreateCommentAction
{
    public function execute(User $user, array $data): Comment
    {
        return Comment::create([
            'thread_id' => $data['thread_id'],
            'parent_id' => $data['parent_id'] ?? null,
            'body' => $data['body'],
            'user_id' => $user->id,
        ]);
    }
}
