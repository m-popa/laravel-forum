<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Support\Str;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\InteractsWithStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CommentObserver::class])]
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

    /**
     * @noinspection PhpUnused
     * Used via Eloquent attribute: $comment->user_vote
     */
    protected function userVote(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->votes
                ->firstWhere('user_id', Auth::id())?->is_liked ?? null
        )->shouldCache();
    }

    /**
     * @noinspection PhpUnused
     * Used via Eloquent attribute: $comment->votes_count
     */
    protected function votesCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->votes->where('is_liked', true)->count()
                - $this->votes->where('is_liked', false)->count()
        )->shouldCache();
    }

    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
