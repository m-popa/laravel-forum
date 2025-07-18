<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentVote extends Model
{
    protected $fillable = [
        'is_liked',
        'comment_id',
        'user_id',
    ];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isLiked(): bool
    {
        return $this->is_liked === true;
    }

    public function isDisliked(): bool
    {
        return $this->is_liked === false;
    }

    protected function casts(): array
    {
        return [
            'is_liked' => 'boolean',
        ];
    }
}
