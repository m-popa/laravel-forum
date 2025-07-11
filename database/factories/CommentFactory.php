<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'body' => $this->faker->paragraphs(2, true),
            'user_id' => User::factory(),
            'thread_id' => Thread::inRandomOrder()->first()?->id ?? Thread::factory(),
            'parent_id' => null,
        ];
    }

    /**
     * Define a state for nested replies (replies to replies).
     */
    public function nested(Comment $parent): Factory
    {
        return $this->state(fn() => [
            'thread_id' => $parent->thread_id,
            'parent_id' => $parent->id,
        ]);
    }
}
