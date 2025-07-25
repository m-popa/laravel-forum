<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Thread;
use App\Models\Category;
use App\Data\ThreadData;

final class CreateThreadAction
{
    public function execute(User $user, Category $category, ThreadData $data): Thread
    {
        return Thread::create([
            'title' => $data->title,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
    }
}
