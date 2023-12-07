<?php

namespace Database\Factories;

use App\Models\Word;
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
        $words = Word::all()->pluck('id')->toArray();
        return [
            'word_id' => fake()->randomElement($words),
            'meaning' => fake()->word(),
            'example' => fake()->sentence(),
            'example_meaning' => fake()->sentence(),
            'image' => fake()->imageUrl(640, 480, 'people', true),
        ];
    }
}
