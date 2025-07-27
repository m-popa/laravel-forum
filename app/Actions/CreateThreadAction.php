<?php

declare(strict_types=1);

namespace App\Actions;

use App\Data\ThreadData;
use App\Models\Category;
use App\Models\Thread;
use App\Models\User;

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
