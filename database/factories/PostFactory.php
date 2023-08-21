<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'creator_id' => User::inRandomOrder()->value('id'),
            'website_id' => Website::inRandomOrder()->value('id'),
            'title' => fake()->sentence(10),
            'description' => fake()->sentence(500),
        ];
    }
}
