<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            if ($question->type === 'writing') {
                Answer::factory()->create([
                    'question_id' => $question->id,
                    'content' => fake()->word(),
                    'is_correct' => 1,
                ]);
            } elseif ($question->type === 'choice') {
                Answer::factory(3)->create([
                    'question_id' => $question->id,
                    'content' => fake()->word(),
                    'is_correct' => 0,
                ]);

                Answer::factory()->create([
                    'question_id' => $question->id,
                    'content' => fake()->word(),
                    'is_correct' => 1,
                ]);
            }
        }
    }
}
