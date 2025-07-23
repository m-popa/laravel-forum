<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\InteractsWithStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use InteractsWithStatus;

    protected $fillable = [
        'body',
        'status',
        'user_id',
        'thread_id',
        'parent_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function vote(User $user, bool $isLiked): CommentVote
    {
        return $this->votes()->create([
            'user_id' => $user->id,
            'is_liked' => $isLiked,
        ]);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(CommentVote::class);
    }

    /**
     * @noinspection PhpUnused
     * Used via Eloquent attribute: $comment->preview_body
     */
    protected function previewBody(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::limit($this->body)
        )->shouldCache();
    }

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
