<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\InteractsWithStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;
    use Sluggable;
    use InteractsWithStatus;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'content',
        'views',
        'is_pinned',
        'is_locked',
        'last_commented_at',
        'user_id',
        'category_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function url(): string
    {
        return route('threads.show', [
            'category' => $this->category->slug,
            'thread' => $this->slug,
        ]);
    }

    public function lock(): void
    {
        $this->update(['is_locked' => true]);
    }

    public function unlock(): void
    {
        $this->update(['is_locked' => false]);
    }

    public function pin(): void
    {
        $this->update(['is_pinned' => true]);
    }

    public function unpin(): void
    {
        $this->update(['is_pinned' => false]);
    }

    public function isNotPinned(): bool
    {
        return !$this->isPinned();
    }

    public function isPinned(): bool
    {
        return $this->is_pinned;
    }

    public function isNotLocked(): bool
    {
        return !$this->isLocked();
    }

    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    /**
     * @noinspection PhpUnused
     * Used via Eloquent attribute: $thread->preview_body
     */
    protected function previewBody(): Attribute
    {
        return Attribute::make(
            get: fn() => Str::limit($this->content)
        )->shouldCache();
    }

    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'views' => 'integer',
            'is_pinned' => 'boolean',
            'is_locked' => 'boolean',
            'last_commented_at' => 'timestamp',
        ];
    }
}
