<?php

namespace App\Models;

use App\Enums\Status;
use App\Interfaces\HasUrl;
use App\Models\Traits\InteractsWithStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Thread extends Model implements HasUrl
{
    use HasFactory;
    use InteractsWithStatus;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'status',
        'body',
        'views',
        'user_id',
        'category_id',
        'pinned_at',
        'locked_at',
        'last_commented_at',
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

    public function lock(): static
    {
        $this->update(['locked_at' => now()]);

        return $this;
    }

    public function unlock(): static
    {
        $this->update(['locked_at' => null]);

        return $this;
    }

    public function pin(): static
    {
        $this->update(['pinned_at' => now()]);

        return $this;
    }

    public function unpin(): static
    {
        $this->update(['pinned_at' => null]);

        return $this;
    }

    public function isNotPinned(): bool
    {
        return ! $this->isPinned();
    }

    public function isPinned(): bool
    {
        return $this->pinned_at !== null;
    }

    public function isNotLocked(): bool
    {
        return ! $this->isLocked();
    }

    public function isLocked(): bool
    {
        return $this->locked_at !== null;
    }

    public function url(): string
    {
        return route('threads.show', [
            'category' => $this->category->slug,
            'thread' => $this->slug,
        ]);
    }

    /**
     * @noinspection PhpUnused
     * Used via Eloquent attribute: $thread->preview_body
     */
    protected function previewBody(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit($this->body)
        )->shouldCache();
    }

    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'views' => 'integer',
            'pinned_at' => 'datetime',
            'locked_at' => 'datetime',
            'last_commented_at' => 'datetime',
        ];
    }
}
