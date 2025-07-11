<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public static function cachedCategories()
    {
        return Cache::rememberForever('categories', static fn() => Category::get());
    }

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
