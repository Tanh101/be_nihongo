<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MeanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word_id' => fake()->numberBetween(1, 10),
            'meaning' => fake()->word(),
            'example' => fake()->sentence(),
            'example_meaning' => fake()->sentence(),
            'image' => fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}
