<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Random\RandomException;

class ThreadFactory extends Factory
{
    protected $model = Thread::class;

    /**
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(random_int(4, 8)),
            'content' => $this->faker->paragraphs(random_int(3, 6), true),
            'views' => $this->faker->numberBetween(0, 1000),
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'last_commented_at' => Carbon::now()->subMinutes(random_int(0, 300)),
        ];
    }
}
