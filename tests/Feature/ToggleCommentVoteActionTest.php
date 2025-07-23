<?php

use App\Actions\ToggleCommentVoteAction;
use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->comment = Comment::factory()->create();
    $this->action = app(ToggleCommentVoteAction::class);
});

it('creates a like vote if no existing vote', function () {
    $result = $this->action->execute($this->comment, true, $this->user);

    expect($result)->toBeTrue();

    $this->assertDatabaseHas('comment_votes', [
        'user_id' => $this->user->id,
        'comment_id' => $this->comment->id,
        'is_liked' => true,
    ]);
});

it('creates a dislike vote if no existing vote', function () {
    $result = $this->action->execute($this->comment, false, $this->user);

    expect($result)->toBeFalse();

    $this->assertDatabaseHas('comment_votes', [
        'user_id' => $this->user->id,
        'comment_id' => $this->comment->id,
        'is_liked' => false,
    ]);
});

it('toggles vote off if user votes same again', function () {
    CommentVote::factory()->create([
        'comment_id' => $this->comment->id,
        'user_id' => $this->user->id,
        'is_liked' => true,
    ]);

    $result = $this->action->execute($this->comment, true, $this->user);

    expect($result)->toBeNull();

    $this->assertDatabaseMissing('comment_votes', [
        'user_id' => $this->user->id,
        'comment_id' => $this->comment->id,
    ]);
});

it('switches vote from like to dislike', function () {
    CommentVote::factory()->create([
        'comment_id' => $this->comment->id,
        'user_id' => $this->user->id,
        'is_liked' => true,
    ]);

    $result = $this->action->execute($this->comment, false, $this->user);

    expect($result)->toBeFalse();

    $this->assertDatabaseHas('comment_votes', [
        'user_id' => $this->user->id,
        'comment_id' => $this->comment->id,
        'is_liked' => false,
    ]);
});

it('switches vote from dislike to like', function () {
    CommentVote::factory()->create([
        'comment_id' => $this->comment->id,
        'user_id' => $this->user->id,
        'is_liked' => false,
    ]);

    $result = $this->action->execute($this->comment, true, $this->user);

    expect($result)->toBeTrue();

    $this->assertDatabaseHas('comment_votes', [
        'user_id' => $this->user->id,
        'comment_id' => $this->comment->id,
        'is_liked' => true,
    ]);
});
