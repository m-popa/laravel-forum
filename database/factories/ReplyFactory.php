<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition(): array
    {
        return [
            'body'       => $this->faker->paragraphs(2, true),
            'user_id'    => User::factory(),
            'thread_id'  => Thread::inRandomOrder()->first()?->id ?? Thread::factory(),
            'parent_id'  => null, // Null by default; for nested replies use state() or manually assign
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    /**
     * Define a state for nested replies (replies to replies).
     */
    public function nested(Reply $parent): Factory
    {
        return $this->state(fn() => [
            'thread_id' => $parent->thread_id,
            'parent_id' => $parent->id,
        ]);
    }
}
