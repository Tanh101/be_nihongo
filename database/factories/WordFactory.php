<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => fake()->word(),
            'pronunciation' => fake()->word(),
            'meaning' => fake()->word(),
            'image' => fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}
