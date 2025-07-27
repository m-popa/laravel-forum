<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $with = [
        'media',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->fit(Fit::Crop, 300, 300)->nonQueued();
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('avatars', 'avatar');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->filter()
            ->map(fn (string $name) => Str::of($name)->substr(0, 1)->upper())
            ->take(2)
            ->implode('');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
