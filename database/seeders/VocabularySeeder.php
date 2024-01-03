<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Vocabulary;
use App\Models\Word;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            Word::where('word', '兄弟')->first()->id,
            Word::where('word', '姉')->first()->id,
            Word::where('word', '妹')->first()->id,
            Word::where('word', '弟')->first()->id,
            Word::where('word', '祖父')->first()->id
        ];

        $vocabularies = [
            [
                'lesson_id' => 1,
                'word_id' => $words[0],
                'user_id' => 1
            ],
            [
                'lesson_id' => 1,
                'word_id' => $words[1],
                'user_id' => 1
            ],
            [
                'lesson_id' => 1,
                'word_id' => $words[2],
                'user_id' => 1
            ],
            [
                'lesson_id' => 1,
                'word_id' => $words[3],
                'user_id' => 1
            ],
            [
                'lesson_id' => 2,
                'word_id' => $words[4],
                'user_id' => 1
            ],
        ];

        $questions = [
            [
                'vocabulary_id' => 1,
                'type' => 'choice',
                'content' => '?は仲が良いです。',
                'meaning' => 'Anh em thân thiết'
            ],
            [
                'vocabulary_id' => 2,
                'type' => 'choice',
                'content' => '?は優れたリーダーシップを持っています。',
                'meaning' => 'Chị gái có khả năng lãnh đạo xuất sắc.'
            ],
            [
                'vocabulary_id' => 3,
                'type' => 'choice',
                'content' => '?と一緒に買い物に行く。',
                'meaning' => 'Đi mua sắm cùng em gái.'
            ],
            [
                'vocabulary_id' => 4,
                'type' => 'choice',
                'content' => '?はサッカーが大好きです。',
                'meaning' => 'Đi mua sắm cùng em gái.'
            ],
            [
                'vocabulary_id' => 5,
                'type' => 'writing',
                'content' => '祖?は毎朝新聞を読みます。',
                'meaning' => 'Ông nội đọc báo mỗi sáng.'
            ]
        ];

        $answers = [
            [
                'question_id' => 1,
                'content' => '椅子',
                'is_correct' => 0
            ],
            [
                'question_id' => 1,
                'content' => '兄弟',
                'is_correct' => 1
            ],
            [
                'question_id' => 1,
                'content' => '猫',
                'is_correct' => 0
            ],
            [
                'question_id' => 1,
                'content' => 'テレビ',
                'is_correct' => 0
            ],
            //2
            [
                'question_id' => 2,
                'content' => '姉',
                'is_correct' => 1
            ],
            [
                'question_id' => 2,
                'content' => '謝',
                'is_correct' => 0
            ],
            [
                'question_id' => 2,
                'content' => '持',
                'is_correct' => 0
            ],
            [
                'question_id' => 2,
                'content' => '優',
                'is_correct' => 0
            ],
            //3
            [
                'question_id' => 3,
                'content' => '名前',
                'is_correct' => 0
            ],
            [
                'question_id' => 3,
                'content' => 'チョコレート',
                'is_correct' => 0
            ],
            [
                'question_id' => 3,
                'content' => '手',
                'is_correct' => 0
            ],
            [
                'question_id' => 3,
                'content' => '妹',
                'is_correct' => 1
            ],
            //4
            [
                'question_id' => 4,
                'content' => '弟',
                'is_correct' => 1
            ],
            [
                'question_id' => 4,
                'content' => 'チョ',
                'is_correct' => 0
            ],
            [
                'question_id' => 4,
                'content' => 'すめ',
                'is_correct' => 0
            ],
            [
                'question_id' => 4,
                'content' => '成長',
                'is_correct' => 0
            ],
            //
            [
                'question_id' => 5,
                'content' => '父',
                'is_correct' => 1
            ],
        ];

        foreach ($vocabularies as $vocabulary) {
            Vocabulary::create($vocabulary);
        }
        foreach ($questions as $question) {
            Question::create($question);
        }
        foreach ($answers as $answer) {
            Answer::create($answer);
        }
    }
}
