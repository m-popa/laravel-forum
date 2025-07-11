<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use App\Models\Thread;
use App\Models\Category;

final class CreateThreadAction
{
    /**
     * @param  User      $user
     * @param  Category  $category
     * @param  array     $data
     *
     * @return Thread
     */
    public function execute(User $user, Category $category, array $data): Thread
    {
        return Thread::create([
            'title'       => $data['title'],
            'content'     => $data['content'],
            'user_id'     => $user->id,
            'category_id' => $category->id,
        ]);
    }
}

