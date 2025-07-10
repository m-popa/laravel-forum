<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function saved(Category $category): void
    {
        $this->clearCache();
    }

    private function clearCache(): void
    {
        Cache::forget('categories');
    }

    public function deleted(Category $category): void
    {
        $this->clearCache();
    }
}
