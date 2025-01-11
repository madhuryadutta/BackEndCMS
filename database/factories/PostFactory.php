<?php

namespace Database\Factories;

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
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'tags' => json_encode($this->faker->words(3)),
            'reactions' => json_encode([
                'likes' => $this->faker->numberBetween(0, 1000),
                'dislikes' => $this->faker->numberBetween(0, 100)
            ]),
            'views' => $this->faker->numberBetween(0, 10000),
            'user_id' => $this->faker->numberBetween(1, 100),
        ];
    }
}
