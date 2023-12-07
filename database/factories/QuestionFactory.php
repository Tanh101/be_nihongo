<?php

namespace Database\Factories;

use App\Models\Vocabulary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vocabularies = Vocabulary::all()->pluck('id')->toArray();

        return [
            'vocabulary_id' => fake()->randomElement($vocabularies),
            'type' => fake()->randomElement(['choice', 'writing']),
            'content' => fake()->sentence(6),
            'meaning' => fake()->word(),
        ];
    }
}
