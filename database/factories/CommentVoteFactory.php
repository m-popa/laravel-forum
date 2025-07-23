<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentVoteFactory extends Factory
{
    protected $model = CommentVote::class;

    public function definition(): array
    {
        return [
            'is_liked' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'comment_id' => Comment::factory(),
            'user_id' => User::factory(),
        ];
    }
}
