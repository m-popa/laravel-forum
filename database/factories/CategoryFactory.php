<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $names = [
            'General Discussion',
            'Laravel Help',
            'Laravel Packages',
            'Jobs & Freelance',
            'Tutorials & Resources',
            'Announcements',
            'Off-Topic',
        ];

        $name = $this->faker->unique()->randomElement($names);

        return [
            'name'        => $name,
            'description' => $this->faker->sentence(12),
        ];
    }
}
