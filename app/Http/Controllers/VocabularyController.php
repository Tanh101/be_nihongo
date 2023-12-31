<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lesson;
use App\Models\Mean;
use App\Models\Question;
use App\Models\Vocabulary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VocabularyController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/dashboard/vocabularies/{id}",
     *     summary="Create vocabularies and questions",
     *     tags={"Vocabylary and Question"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          description="Lesson ID",
     *          in="path",
     *          name="id",
     *          required=true,
     *      ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *              @OA\Property(
     *                  property="vocabularies",
     *                  type="array",
     *                  description="Vocabularies",
     *                  @OA\Items(
     *                     @OA\Property(
     *                          property="word",
     *                          type="string",
     *                          description="Word"
     *                      ),
     *                      @OA\Property(
     *                          property="questions",
     *                          type="array",
     *                          description="Questions",
     *                          @OA\Items(
     *                              @OA\Property(
     *                                  property="type",
     *                                  type="enum",
     *                                  enum={"writing", "choice"},
     *                                  description="Type"
     *                              ),
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
     *                                  property="answers",  
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
    public function create_vocabularies_questions(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vocabularies' => 'required|array',
            'vocabularies.*.id' => 'required|string|max:255',
            'vocabularies.*.questions' => 'required|array',
            'vocabularies.*.questions.*.type' => 'required|string|max:255',
            'vocabularies.*.questions.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.meaning' => 'required|string|max:255',
            'vocabularies.*.questions.*.answers' => 'required|array',
            'vocabularies.*.questions.*.answer.*.content' => 'required|string|max:255',
            'vocabularies.*.questions.*.answer.*.is_correct' => 'int|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson Not Found',
            ], 404);
        }

        DB::beginTransaction();

        try {
            $vocabularies = $request->vocabularies;

            foreach ($vocabularies as $vocabulary) {
                $word = Word::where('id', $vocabulary['id'])->first();
                if (!$word) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Word not found',
                    ], 404);
                }

                $vocabularyInDB = Vocabulary::where('word_id', $word->id)->first();

                if (!$vocabularyInDB) {
                    $vocabularyInDB = Vocabulary::create([
                        'user_id' => auth()->user()->id,
                        'word_id' => $word->id,
                        'lesson_id' => $id,
                    ]);
                }

                    $questions = $vocabulary['questions'];
                    foreach ($questions as $question) {
                    //check type question
                    if ($question['type'] != 'writing' && $question['type'] != 'choice') {
                        return response()->json([
                            'success' => false,
                            'message' => 'Question Creation Error - Type is not valid',
                        ], 500);
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
                            return response()->json([
                                'success' => false,
                                'message' => 'Answer Creation Error',
                            ], 500);
                        }
                    } else if ($newQuestion->type == 'choice') {
                        $countCorrect = 0;

                        if (count($answers) < 4) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Answer Creation Error',
                            ], 500);
                        }

                        //check correct answer is only one
                        foreach ($answers as $answer) {
                            if ($answer['is_correct'] == 1) {
                                $countCorrect++;
                            }
                        }

                        if ($countCorrect != 1) {
                            return response()->json([
                                'success' => false,
                                'message' => 'Answer Creation Error - Correct Answer is only one',
                            ], 500);
                        }

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
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vocabulary Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Server Error',
            ], 500);
        }
    }
}
