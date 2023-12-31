<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topics = Topic::all()->pluck('id')->toArray();
        return [
            'title' => fake()->sentence(6),
            'description' => fake()->text(20),
            'image' => fake()->imageUrl(640, 480, 'people', true),
            'topic_id' => fake()->randomElement($topics),
        ];
    }
}
