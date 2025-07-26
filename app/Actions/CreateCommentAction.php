<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Enums\Status;
use App\Models\Comment;
use App\Data\CommentData;
use App\Settings\GeneralSettings;

final readonly class CreateCommentAction
{
    public function __construct(
        private GeneralSettings $settings,
    ) {
    }

    public function execute(User $user, CommentData $data): Comment
    {
        return Comment::create([
            'thread_id' => $data->thread_id,
            'body' => $data->body,
            'parent_id' => $data->parent_id,
            'user_id' => $user->id,
            'status' => $this->settings->comment_moderation_enabled
                ? Status::Pending
                : Status::Published,
        ]);
    }
}
