<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Vocabulary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VocabularyController extends Controller
{
    // /**
    //  * @OA\Post(
    //  *     path="/api/dashboard/vocabulary",
    //  *     summary="Create a new vocabulary",
    //  *     tags={"Vocabulary"},
    //  *     security={{"bearerAuth":{}}},
    //  *     @OA\RequestBody(
    //  *         required=true,
    //  *         @OA\JsonContent(
    //  *                 @OA\Property(
    //  *                     property="lesson_id",
    //  *                     type="string",
    //  *                     description="Lesson ID"
    //  *                 ),
    //  *                  @OA\Property(
    //  *                     property="word",
    //  *                     type="string",
    //  *                     description="Word"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="meaning",
    //  *                     type="string",
    //  *                     description="Meaning"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="pronunciation",
    //  *                     type="string",
    //  *                     description="Pronunciation"
    //  *                 ),
    //  *                 @OA\Property(
    //  *                     property="image",
    //  *                     type="string",
    //  *                     description="Image"
    //  *                 )
    //  *         )
    //  *     ),
    //  *     @OA\Response(
    //  *          response="200",
    //  *          description="Create vocabulary successfully",
    //  *          @OA\JsonContent(
    //  *                  @OA\Property(
    //  *                      property="success",
    //  *                      type="string",
    //  *                      description="Success"
    //  *                  ),
    //  *                  @OA\Property(
    //  *                      property="message",
    //  *                      type="string",
    //  *                      description="Message"
    //  *                  ),
    //  *                  @OA\Property(
    //  *                      property="vocabulary",
    //  *                      type="object",
    //  *                      description="Vocabulary",
    //  *                          type="object",
    //  *                          @OA\Property(
    //  *                              property="id",
    //  *                              type="integer",
    //  *                          ),
    //  *                          @OA\Property(
    //  *                              property="user_id",
    //  *                              type="integer",
    //  *                              description="User ID"
    //  *                          ),
    //  *                          @OA\Property(
    //  *                              property="lesson_id",
    //  *                              type="integer",
    //  *                              description="Lesson ID"
    //  *                          ),
    //  *                          @OA\Property(
    //  *                              property="word_id",
    //  *                              type="integer",
    //  *                              description="Word ID"
    //  *                          ),
    //  *                          @OA\Property(
    //  *                                  property="word",
    //  *                                  type="object",
    //  *                                  description="word",
    //  *                                  @OA\Property(
    //  *                                     property="id",
    //  *                                    type="integer",
    //  *                                  ),
    //  *                                  @OA\Property(
    //  *                                      property="word",
    //  *                                      type="string",
    //  *                                  ),
    //  *                                  @OA\Property(
    //  *                                      property="meaning",
    //  *                                      type="string",
    //  *                                  ),
    //  *                                  @OA\Property(
    //  *                                      property="pronunciation",
    //  *                                      type="string",
    //  *                                  ),
    //  *                                  @OA\Property(
    //  *                                      property="image",
    //  *                                      type="string",
    //  *                                  ),
    //  *                          ),
    //  *                     ),
    //  *                 ),
    //  *            ),
    //  *       ),
    //  *   ),
    //  *     @OA\Response(response="400", description="Validation errors"),
    //  *     @OA\Response(response="500", description="Server error"),
    //  * )
    //  */
    // public function create_vocabulary(Request $request)
    // {
    //     $user_id = auth()->user()->id;
    //     $validator = Validator::make($request->all(), [
    //         'lesson_id' => 'required|string|max:255',
    //         'word' => 'required|string|max:255',
    //         'meaning' => 'required|string|max:255',
    //         'pronunciation' => 'required|string|max:255',
    //         'image' => 'nullable|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation Error',
    //             'errors' => $validator->errors(),
    //         ], 400);
    //     }


    //     $word = Word::create([
    //         'word' => $request->word,
    //         'pronunciation' => $request->pronunciation,
    //         'meaning' => $request->meaning,
    //         'image' => $request->image,
    //     ]);

    //     if ($word->id == null) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Word Creation Error',
    //         ], 500);
    //     }

    //     $vocabulary = Vocabulary::create([
    //         'user_id' => $user_id,
    //         'lesson_id' => $request->lesson_id,
    //         'word_id' => $word->id,
    //     ]);

    //     if ($vocabulary->id == null) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Vocabulary Creation Error',
    //         ], 500);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Vocabulary Created Successfully',
    //         'vocabulary' => $vocabulary->load('word'),
    //     ], 200);
    // }

    /**
     * @OA\Post(
     *     path="/api/dashboard/vocabularies",
     *     summary="Create vocabularies and questions",
     *     tags={"Vocabylary and Question"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *              @OA\Property(
     *                  property="lesson_id",
     *                  type="string",
     *                  description="Lesson ID"
     *              ),
     *              @OA\Property(
     *                  property="vocabularies",
     *                  type="array",
     *                  description="Vocabularies",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="word",
     *                          type="string",
     *                          description="Word"
     *                      ),
     *                      @OA\Property(
     *                          property="meaning",
     *                          type="string",
     *                          description="Meaning"
     *                      ),
     *                      @OA\Property(
     *                          property="pronunciation",
     *                          type="string",
     *                          description="Pronunciation"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string",
     *                          description="Image"
     *                      ),
     *                      @OA\Property(
     *                          property="questions",
     *                          type="array",
     *                          description="Questions",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="content",
     *                                  type="string",
     *                                  description="Content"
     *                              ),
     *                              @OA\Property(
     *                                  property="meaning",
     *                                  type="string",
     *                                  description="Meaning"
     *                              ),
     *                              @OA\Property(
     *                                  property="answer",  
     *                                  type="array",
     *                                  description="Answer",
     *                                  @OA\Items(
     *                                      @OA\Property(
     *                                          property="content",
     *                                          type="string",
     *                                          description="Content"
     *                                      ),
     *                                      @OA\Property(
     *                                          property="is_correct",
     *                                          type="integer",
     *                                          description="Is Correct"
     *                                      ),
     *                                      example={
     *                                          "content": "answer 1",
     *                                          "is_correct": 1
     *                                      }
     *                                  ),
     *                              ),
     *                          ),
     *                      ),
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="Create vocabulaies and questions successfully"),
     *     @OA\Response(response="404", description="lesson not found"),
     *     @OA\Response(response="500", description="Server error"),
     *)
     */
    public function create_vocabularies_questions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|string|max:255',
            'vocabularies' => 'required|array',
            'vocabularies.*.word' => 'required|string|max:255',
            'vocabularies.*.meaning' => 'required|string|max:255',
            'vocabularies.*.pronunciation' => 'required|string|max:255',
            'vocabularies.*.image' => 'nullable|string|max:255',
            'vocabularies.*.questions' => 'required|array',
            'vocabularies.*.questions.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.meaning' => 'required|string|max:255',
            'vocabularies.*.questions.*.answers' => 'required|array',
            'vocabularies.*.questions.*.answer.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.answer.*.is_correct' => 'required|int|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $lesson_id = $request->lesson_id;
        $lesson = Lesson::find($lesson_id);
        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson Not Found',
            ], 404);
        }


        $vocabularies = $request->vocabularies;
        foreach ($vocabularies as $vocabulary) {
            $newWord = Word::create([
                'word' => $vocabulary['word'],
                'pronunciation' => $vocabulary['pronunciation'],
                'meaning' => $vocabulary['meaning'],
                'image' => $vocabulary['image'],
            ]);

            if (!$newWord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Word Creation Error',
                ], 500);
            }

            $newVocabulary = Vocabulary::create([
                'user_id' => auth()->user()->id,
                'lesson_id' => $lesson_id,
                'word_id' => $newWord->id,
            ]);

            if (!$newVocabulary) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vocabulary Creation Error',
                ], 500);
            }

            $questions = $vocabulary['questions'];
            foreach ($questions as $question) {
                $newQuestion = Question::create([
                    'vocabulary_id' => $newVocabulary->id,
                    'content' => $question['content'],
                    'meaning' => $question['meaning'],
                ]);

                if (!$newQuestion) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Question Creation Error',
                    ], 500);
                }

                $answers = $question['answers'];
                foreach ($answers as $answer) {
                    $newAnswer = Answer::create([
                        'question_id' => $newQuestion->id,
                        'content' => $answer['content'],
                        'is_correct' => $answer['is_correct'],
                    ]);

                    if (!$newAnswer) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Answer Creation Error',
                        ], 500);
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Vocabulary Created Successfully',
        ], 200);
    }
}
