<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name', 'slug', 'description'];

    public static function cachedCategories(): Collection
    {
        return Cache::rememberForever('categories', static fn () => Category::get());
    }

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }
}
