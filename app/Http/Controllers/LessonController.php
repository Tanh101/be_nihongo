<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Vocabulary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class LessonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard/lessons",
     *     summary="Get all lessons by status",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"active", "deleted"},
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             enum={10, 15, 20},
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cur_page",
     *         in="query",
     *         description="Current page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get lessons successfully"),
     *     @OA\Response(response="500", description="Server error"),
     *     @OA\Response(response="404", description="Lessons not found"),
     * )
     */
    public function get_all_lessons_admin(Request $request)
    {
        $status = $request->status;
        $title = $request->title;
        $curPage = $request->input('cur_page', 1);
        $perPage = $request->input('per_page', 10);

        if ($status == null) {
            if ($title) {
                $lessons = Lesson::where('title', $title)->paginate($perPage, ['*'], 'page', $curPage);
            } else {
                $lessons = Lesson::paginate($perPage, ['*'], 'page', $curPage);
            }
        } else if ($status == 'deleted') {
            $lessons = Lesson::onlyTrashed()->paginate($perPage, ['*'], 'page', $curPage);
        } else {
            $lessons = Lesson::where('status', $status)->paginate($perPage, ['*'], 'page', $curPage);
        }

        if ($lessons->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No lessons found',
            ], 404);
        }

        $totalPages = ceil($lessons->total() / $perPage);
        $pagination = [
            'per_page' => $lessons->perPage(),
            'current_page' => $lessons->currentPage(),
            'total_pages' => $totalPages,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Get lessons successfully',
            'total_result' => $lessons->total(),
            'pagination' => $pagination,
            'lessons' => $lessons->items()
        ], 200);
    }

    public function get_lesson_by_id($id)
    {
        $result = Lesson::with([
            'vocabularies.word',
            'vocabularies.questions.answers',
            'vocabularies.word.means',
        ])->find($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get lesson successfully',
            'lesson' => $result
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/dashboard/lessons",
     *     summary="Create a new lesson",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Title",
     *                     example="Lesson 1"
     *                 ),
     *                  @OA\Property(
     *                     property="topic_id",
     *                     type="integer",
     *                     description="Topic ID",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Description",
     *                     example="Các từ vựng về gia đình"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     description="Image"
     *                 )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Create lesson successfully"),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(response="404", description="Topic not found"),
     *     @OA\Response(response="500", description="Server error"),
     * )
     */
    public function create_lesson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'vocabularies' => 'required|array',
            'vocabularies.*.word_id' => 'required|string|max:255',
            'vocabularies.*.questions' => 'required|array',
            'vocabularies.*.questions.*.type' => 'required|string|max:255',
            'vocabularies.*.questions.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.meaning' => 'required|string|max:255',
            'vocabularies.*.questions.*.answers' => 'required|array',
            'vocabularies.*.questions.*.answer.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.answer.*.is_correct' => 'int|max:1',
        ]);

        if ($validator->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Create lesson failed',
                'data' => $validator->errors()
            ], 400);
        }

        $topic = Topic::find($request->topic_id);

        if (!$topic) {
            return response()->json([
                'success' => false,
                'message' => 'Topic not found'
            ], 404);
        }

        try {
            DB::beginTransaction();

            $lesson = Lesson::create([
                'title' => $request->title,
                'description' => $request->description,
                'topic_id' => $request->topic_id,
                'image' => $request->image ?? null,
            ]);

            if (!$lesson) {
                // return response()->json([
                //     'success' => false,
                //     'message' => 'Create lesson failed',
                // ], 500);
                throw new \Exception('Create lesson failed', 500);
            }

            $vocabularies = $request->vocabularies;

            foreach ($vocabularies as $vocabulary) {
                $word = Word::where('id', $vocabulary['word_id'])->first();
                if (!$word) {
                    // return response()->json([
                    //     'success' => false,
                    //     'message' => 'Word not found',
                    // ], 404);
                    throw new \Exception('Word not found', 404);
                }

                $vocabularyInDB = Vocabulary::where('word_id', $word->id)->first();

                if (!$vocabularyInDB) {
                    $vocabularyInDB = Vocabulary::create([
                        'user_id' => auth()->user()->id,
                        'word_id' => $word->id,
                        'lesson_id' => $lesson->id,
                    ]);
                }

                $questions = $vocabulary['questions'];
                foreach ($questions as $question) {
                    //check type question
                    if ($question['type'] != 'writing' && $question['type'] != 'choice') {
                        // return response()->json([
                        //     'success' => false,
                        //     'message' => 'Question Creation Error - Type is not valid',
                        // ], 500);
                        throw new \Exception('Question Creation Error - Type is not valid', 500);
                    }

                    $newQuestion = Question::create([
                        'vocabulary_id' => $vocabularyInDB->id,
                        'type' => $question['type'],
                        'content' => $question['content'],
                        'meaning' => $question['meaning'],
                    ]);



                    if (!$newQuestion) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Question Creation Error',
                        ], 500);
                    }

                    //check type question and create answer
                    $answers = $question['answers'];
                    if ($newQuestion->type == 'writing') {
                        $answer = Answer::create([
                            'question_id' => $newQuestion->id,
                            'content' => $answers[0]['content'],
                            'is_correct' => 1,
                        ]);

                        if (!$answer) {
                            // return response()->json([
                            //     'success' => false,
                            //     'message' => 'Answer Creation Error',
                            // ], 500);
                            throw new \Exception('Answer Creation Error', 500);
                        }
                    } else if ($newQuestion->type == 'choice') {
                        $countCorrect = 0;

                        if (count($answers) < 4) {
                            // return response()->json([
                            //     'success' => false,
                            //     'message' => 'Answer Creation Error',
                            // ], 500);
                            throw new \Exception('Answer Creation Error', 500);
                        }

                        //check correct answer is only one
                        foreach ($answers as $answer) {
                            if ($answer['is_correct'] == 1) {
                                $countCorrect++;
                            }
                        }

                        if ($countCorrect != 1) {
                            // return response()->json([
                            //     'success' => false,
                            //     'message' => 'Answer Creation Error - Correct Answer is only one',
                            // ], 500);
                            throw new \Exception('Answer Creation Error - Correct Answer is only one', 500);
                        }

                        foreach ($answers as $answer) {
                            $newAnswer = Answer::create([
                                'question_id' => $newQuestion->id,
                                'content' => $answer['content'],
                                'is_correct' => $answer['is_correct'],
                            ]);

                            if (!$newAnswer) {
                                // return response()->json([
                                //     'success' => false,
                                //     'message' => 'Answer Creation Error',
                                // ], 500);
                                throw new \Exception('Answer Creation Error', 500);
                            }
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Create lesson and questions successfully',
                'lesson' => $lesson
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Create lesson failed',
                'data' => $e->getMessage()
            ], $e->getCode());
        }
    }

    /**
     * @OA\Put(
     *     path="/api/dashboard/lessons/{id}",
     *     summary="Update a lesson by ID",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID",
     *         example=1,
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Title"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Description"
     *                 ),
     *                 @OA\Property(
     *                     property="image",
     *                     type="string",
     *                     description="Image"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Update lesson successfully"),
     *     @OA\Response(response="404", description="Lesson not found"),
     *     @OA\Response(response="500", description="Server error"),
     * )
     */
    public function update_lesson(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'vocabularies' => 'required|array',
            'vocabularies.*.id' => 'required|string|max:255',
            'vocabularies.*.questions' => 'required|array',
            'vocabularies.*.questions.*.id' => 'required|string|max:255',
            'vocabularies.*.questions.*.type' => 'required|string|max:255',
            'vocabularies.*.questions.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.meaning' => 'required|string|max:255',
            'vocabularies.*.questions.*.answers' => 'required|array',
            'vocabularies.*.questions.*.answer.*.id' => 'required|string|max:255',
            'vocabularies.*.questions.*.answer.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.answer.*.is_correct' => 'int|max:1',
        ]);

        if ($validator->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Update lesson failed',
                'data' => $validator->errors()
            ], 400);
        }

        $lesson = Lesson::find($request->id);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
            ], 404);
        }

        $lesson->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image ?? null,
        ]);

        $vocabularies = $request->vocabularies;

        foreach ($vocabularies as $vocabulary) {
            $questions = $vocabulary['questions'];
            $voca = Vocabulary::find($vocabulary['id']);
            if (!$voca) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vocabulary not found'
                ], 404);
            }
            $voca->update([
                'word_id' => $vocabulary['word_id'],
            ]);

            foreach ($questions as $question) {
                if ($question['type'] != 'writing' && $question['type'] != 'choice') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Question Creation Error - Type is not valid',
                    ], 500);
                }

                $ques = Question::find($question['id']);
                if (!$ques) {
                    $ques = Question::create([
                        'vocabulary_id' => $voca->id,
                        'content' => $question['content'],
                        'meaning' => $question['meaning'],
                        'type' => $question['type'],
                    ]);
                    if (!$ques) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Question create fails'
                        ], 500);
                    }
                } else {
                    $ques->update([
                        'type' => $question['type'],
                        'content' => $question['content'],
                        'meaning' => $question['meaning'],
                    ]);
                }

                $answers = $question['answers'];
                foreach ($answers as $answer) {
                    $ans = Answer::find($answer['id']);
                    if (!$ans) {
                        $newAnser = Answer::create([
                            'question_id' => $ques->id,
                            'content' => $answer['content'],
                            'is_correct' => $answer['is_correct'],
                        ]);
                        if (!$newAnser) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Answer create fails',
                            ], 404);
                        }
                    } else {
                        $ans->update([
                            'content' => $answer['content'],
                            'is_correct' => $answer['is_correct'],
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Update lesson successfully',
            'lesson' => $lesson
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/dashboard/lessons/{id}",
     *     summary="Delete a lesson by ID",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID",
     *         required=true,
     *         example=1,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Delete lesson successfully"),
     *     @OA\Response(response="404", description="Lesson not found"),
     * )
     */
    public function delete_lesson(Request $request, $id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
            ], 404);
        }

        $vocabularies = $lesson->vocabularies;
        foreach ($vocabularies as $vocabulary) {
            $vocabulary->delete();
        }
        $lesson->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete lesson successfully',
            'lesson' => $lesson
        ], 200);
    }

    /**
     * @OA\Patch(
     *     path="/api/dashboard/lessons/{id}",
     *     summary="Restore a lesson by ID",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Restore lesson successfully"),
     *     @OA\Response(response="404", description="Lesson not found"),
     * )
     */
    public function restore_lesson($id)
    {
        $lesson = Lesson::onlyTrashed()->find($id);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
            ], 404);
        }

        $lesson->restore();

        return response()->json([
            'success' => true,
            'message' => 'Restore lesson successfully',
            'lesson' => $lesson
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/lessons/{id}",
     *     summary="Get all lessons by status",
     *     tags={"Lessons"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Lesson ID",
     *         required=true,
     *         example=10,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *     response="200",
     *     description="Successful response",
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="success", type="boolean", example=true),
     *         @OA\Property(property="message", type="string", example="Get vocabularies successfully"),
     *         @OA\Property(property="lesson", type="object",
     *             @OA\Property(property="id", type="integer", example=10),
     *             @OA\Property(property="topic_id", type="integer", example=6),
     *             @OA\Property(property="title", type="string", example="Repellat suscipit magnam laborum."),
     *             @OA\Property(property="description", type="string", example="Distinctio omnis hic voluptatum eum in suscipit molestiae tempore accusantium commodi sed cum nihil quas eveniet possimus."),
     *             @OA\Property(property="image", type="string", example="https://via.placeholder.com/640x480.png/005566?text=people+error"),
     *             @OA\Property(property="status", type="string", example="active"),
     *             @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-15T06:54:04.000000Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-15T06:54:04.000000Z"),
     *             @OA\Property(property="vocabularies", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="lesson_id", type="integer", example=10),
     *                     @OA\Property(property="user_id", type="integer", example=1),
     *                     @OA\Property(property="word_id", type="integer", example=11),
     *                     @OA\Property(property="status", type="string", example="active"),
     *                     @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-15T15:42:02.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-15T15:42:05.000000Z"),
     *                     @OA\Property(property="word", type="object",
     *                         @OA\Property(property="id", type="integer", example=11),
     *                         @OA\Property(property="word", type="string", example="突く"),
     *                         @OA\Property(property="pronunciation", type="string", example="つく"),
     *                         @OA\Property(property="sino_vietnamese", type="string", example="ĐỘT"),
     *                         @OA\Property(property="image", type="string", example="https::/migroupvn.com"),
     *                         @OA\Property(property="means", type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="word_id", type="integer", example=1),
     *                             @OA\Property(property="meaning", type="string", example="meaning 1"),
     *                             @OA\Property(property="example", type="string", example="example 1"),
     *                             @OA\Property(property="example_meaning", type="string", example="example maneing 1"),
     *                             @OA\Property(property="status", type="string", example="active"),
     *                         ),
     *                          ),
     *                     ),
     *                     @OA\Property(property="questions", type="array",
     *                         @OA\Items(
     *                             type="object",
     *                             @OA\Property(property="id", type="integer", example=1),
     *                             @OA\Property(property="vocabulary_id", type="integer", example=1),
     *                             @OA\Property(property="content", type="string", example="question 1"),
     *                             @OA\Property(property="meaning", type="string", example="meaning 1"),
     *                             @OA\Property(property="status", type="string", example="active"),
     *                         ),
     *                     ),
     *                 ),
     *             ),
     *          ),
     *       ),
     *     ),
     *     @OA\Response(response="404", description="Lessons not found"),
     * )
     */
    public function getVocabulariesByLessonId(Request $request, $id)
    {
        $result = Lesson::with([
            'vocabularies.word',
            'vocabularies.questions' => function ($query) {
                $query->where('type', 'choice')->with('answers:id,question_id,content')
                    ->orWhere('type', 'writing');
            },
            'vocabularies.word.means',
        ])->find($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get vocabularies successfully',
            'lesson' => $result
        ], 200);
    }
}
