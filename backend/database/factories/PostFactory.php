<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            // 'user_id' => $this->faker->randomDigit,
            'user_id' => User::inRandomOrder()->first()->id,
            // 'category_id' => $this->faker->randomDigit,
            'title' => $this->faker->sentence(rand(5, 10), true),
            'content' => $this->faker->sentence(15, true),
            'image' => 'https://via.placeholder.com/1000',
            'slug' => $this->faker->slug(),
        ];
    }
}
