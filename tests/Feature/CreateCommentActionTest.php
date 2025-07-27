<?php

use App\Models\User;
use App\Enums\Status;
use App\Models\Thread;
use App\Models\Comment;
use App\Data\CommentData;
use App\Settings\GeneralSettings;
use App\Actions\CreateCommentAction;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->thread = Thread::factory()->create();
    $this->settings = app(GeneralSettings::class);
    $this->action = app(CreateCommentAction::class);
});

it('creates a new comment', function () {
    $commentData = new CommentData(
        body: 'This is a test comment',
        thread_id: $this->thread->id,
        parent_id: null,
    );

    $comment = $this->action->execute($this->user, $commentData);

    expect($comment)
        ->body->toBe('This is a test comment')
        ->user_id->toBe($this->user->id)
        ->thread_id->toBe($this->thread->id)
        ->parent_id->toBeNull()
        ->status->toBe(Status::Published);

    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
        'body' => 'This is a test comment',
        'user_id' => $this->user->id,
        'thread_id' => $this->thread->id,
        'parent_id' => null,
        'status' => Status::Published->value,
    ]);
});

it('creates a reply to an existing comment', function () {
    $parentComment = Comment::factory()->create([
        'thread_id' => $this->thread->id,
        'user_id' => User::factory()->create(),
    ]);

    $commentData = new CommentData(
        body: 'This is a reply',
        thread_id: $this->thread->id,
        parent_id: $parentComment->id,
    );

    $comment = $this->action->execute($this->user, $commentData);

    expect($comment)
        ->body->toBe('This is a reply')
        ->parent_id->toBe($parentComment->id);

    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
        'body' => 'This is a reply',
        'parent_id' => $parentComment->id,
    ]);
});

it('creates a pending comment when moderation is enabled', function () {
    $this->settings->comment_moderation_enabled = true;

    $commentData = new CommentData(
        body: 'This comment needs moderation',
        thread_id: $this->thread->id,
        parent_id: null,
    );

    $comment = $this->action->execute($this->user, $commentData);

    expect($comment->status)->toBe(Status::Pending);
});

it('creates a published comment when moderation is disabled', function () {
    $this->settings->comment_moderation_enabled = false;

    $commentData = new CommentData(
        body: 'This comment is published immediately',
        thread_id: $this->thread->id,
        parent_id: null,
    );

    $comment = $this->action->execute($this->user, $commentData);

    expect($comment->status)->toBe(Status::Published);
});
