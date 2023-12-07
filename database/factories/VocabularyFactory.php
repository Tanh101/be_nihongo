<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vocabulary>
 */
class VocabularyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $words = Word::all()->pluck('id')->toArray();
        $lessons = Lesson::all()->pluck('id')->toArray();
        return [
            'word_id' => fake()->unique()->randomElement($words),
            'lesson_id' => fake()->randomElement($lessons),
            'user_id' => 1,
            'status' => 'active'
        ];
    }
}
