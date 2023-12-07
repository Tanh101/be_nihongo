<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $questions = Question::all();
        $fakeAnswers = [];

        foreach ($questions as $question) {
            if ($question->type === 'writing') {
                $fakeAnswers[] = [
                    'question_id' => $question->id,
                    'content' => fake()->sentence(6),
                    'is_correct' => 1,
                ];
            } else {

                for ($i = 0; $i < 4; $i++) {
                    $fakeAnswers[] = [
                        'question_id' => $question->id,
                        'content' => fake()->sentence(6),
                        'is_correct' => ($i === 0) ? 1 : 0,
                    ];
                }
            }
        }

        return $fakeAnswers;
    }
}
