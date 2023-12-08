<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LearningController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/learn/{id}",
     *      tags={"Learning"},
     *      summary="Learn a lesson by id",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="You are learning this lesson",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="You are learning this lesson"),
     *              @OA\Property(property="lesson", type="object",
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="topic_id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="Lesson 1"),
     *              @OA\Property(property="description", type="string", example="This is lesson 1"),
     *              @OA\Property(property="image", type="string", example="https://www.google.com"),
     *              @OA\Property(property="status", type="string", example="learning"),
     *          ),
     *       ),
     *       @OA\Response(
     *         response=404,
     *         description="Lesson not found",
     *       )
     *     )
     *),
     */
    public function learnBylessonId(Request $request, $id)
    {
        $user = Auth::user();

        $lessonWithId = Lesson::where('id', $id)->get()->first();

        if (!$lessonWithId) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
            ], 404);
        }
        $firstTopic = Topic::orderBy('id', 'asc')->first();
        if ($lessonWithId->topic_id == $firstTopic->id) {
            $firstLesson = Lesson::where('topic_id', $firstTopic->id)->orderBy('id', 'asc')->first();
            if ($firstLesson->id == $lessonWithId->id) {
                // $user->lessons()->sync([$lessonWithId->id => ['status' => 'unlocked', 'lives' => 3]]);
                if (count($user->lessons()->wherePivot('lesson_id', $lessonWithId->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                    $user->lessons()->attach($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
                } else {
                    $user->lessons()->updateExistingPivot($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'You have unlocked this lesson',
                    'lesson' => $lessonWithId
                ], 200);
            }
        }
        if (!$user->lessons->contains($lessonWithId)) {
            return response()->json([
                'success' => false,
                'message' => 'You have not finished previous lesson',
            ], 400);
        }

        if (count($user->lessons()->wherePivot('lesson_id', $lessonWithId->id)->wherePivot('user_id', $user->id)->get()) == 0) {
            $user->lessons()->attach($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
        } else {
            $user->lessons()->updateExistingPivot($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
        }

        return response()->json([
            'success' => true,
            'message' => 'You have unlocked this lesson',
            'lesson' => $lessonWithId
        ], 200);
    }

    /**
     * @OA\Patch(
     *      path="/api/check/{id}",
     *      tags={"Learning"},
     *      summary="Check answer of question",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"question_id", "answer"},
     *              @OA\Property(property="question_id", type="string", example=1),
     *              @OA\Property(property="answer", type="string", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Correct answer",
     *          @OA\JsonContent(
     *            @OA\Property(property="success", type="boolean", example=true),
     *            @OA\Property(property="message", type="string", example="Correct answer"),
     *            @OA\Property(property="correct_answer", type="string", example="answer"),
     *          ),
     *      @OA\Response(
     *          response=400,
     *          description="Missing required fields",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Question or Lesson not found",
     *      ),
     *      ),
     * ),
     */
    public function checkAnswer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|string',
            'answer' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields',
                'errors' => $validator->errors()
            ], 400);
        }
        $quesId = (int) $request->question_id;
        $question = Question::find($quesId);
        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found'
            ], 404);
        }

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
            ], 404);
        }

        $user = Auth::user();
        $correct_answer = $question->answers->where('is_correct', 1)->first();

        //check if question is final question ---- missing ------------------
        $lastVocabulary = Vocabulary::where('lesson_id', $id)->orderBy('id', 'desc')->first();
        $lastQuestion = Question::where('vocabulary_id', $lastVocabulary->id)->orderBy('id', 'desc')->first();

        $isFinalQuestion = false;
        if ($question->id == $lastQuestion->id) {
            $isFinalQuestion = true;
        }
        if (count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
            $lives = $user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->first()->pivot->lives;
        } else {
            $lives = 3;
        }

        if ($question->type == 'choice') {
            if ($request->answer === (string)$correct_answer->id) {
                if ($isFinalQuestion) {
                    if (count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                        $user->lessons()->attach($lesson->id, ['status' => 'finished', 'lives' => 3]);
                    } else {
                        $user->lessons()->updateExistingPivot($lesson->id, ['status' => 'finished', 'lives' => 3]);
                    }

                    //unlocked next lesson
                    $lastLessonInTopic = $this->findLastLessonByTopicId($lesson->topic_id);
                    if ($lastLessonInTopic->id != $lesson->id) {
                        $nextLesson = Lesson::where('topic_id', $lesson->topic_id)->where('id', '>', $lesson->id)->first();
                        if ($nextLesson) {
                            if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                                $user->lessons()->attach($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                            } else {
                                $user->lessons()->updateExistingPivot($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                            }
                        }
                    } else {
                        $nextTopic = Topic::where('id', '>', $lesson->topic_id)->first();
                        if ($nextTopic) {
                            $nextLesson = Lesson::where('topic_id', $nextTopic->id)->first();
                            if ($nextLesson) {
                                if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                                    $user->lessons()->attach($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                                } else {
                                    $user->lessons()->updateExistingPivot($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                                }
                            }
                        }
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Correct answer',
                    'correct_answer' => $correct_answer,
                    'lives' => $lives
                ], 200);
            } else {
                if ($lives >= 1) {
                    $lives -= 1;
                }
                if (count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                    $user->lessons()->attach($lesson->id, ['lives' => $lives]);
                } else {
                    $user->lessons()->updateExistingPivot($lesson->id, ['lives' => $lives]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Wrong answer',
                    'correct_answer' => $correct_answer,
                    'lives' => $lives
                ], 200);
            }
        } else {
            if ($request->answer === $correct_answer->content) {
                if ($isFinalQuestion) {
                    if (count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                        $user->lessons()->attach($lesson->id, ['status' => 'finished', 'lives' => 3]);
                    } else {
                        $user->lessons()->updateExistingPivot($lesson->id, ['status' => 'finished', 'lives' => 3]);
                    }

                    //unlocked next lesson
                    $lastLessonInTopic = $this->findLastLessonByTopicId($lesson->topic_id);
                    if ($lastLessonInTopic->id != $lesson->id) {
                        $nextLesson = Lesson::where('topic_id', $lesson->topic_id)->where('id', '>', $lesson->id)->first();
                        if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                            $user->lessons()->attach($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                        } else {
                            $user->lessons()->updateExistingPivot($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                        }
                    } else {
                        $nextTopic = Topic::where('id', '>', $lesson->topic_id)->first();
                        if ($nextTopic) {
                            $nextLesson = Lesson::where('topic_id', $nextTopic->id)->first();
                            if ($nextLesson) {
                                if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                                    $user->lessons()->attach($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                                } else {
                                    $user->lessons()->updateExistingPivot($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                                }
                            }
                        }
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Correct answer',
                    'correct_answer' => $correct_answer,
                    'lives' => $lives
                ], 200);
            } else {
                if ($lives >= 1) {
                    $lives -= 1;
                }
                if (count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                    $user->lessons()->attach($lesson->id, ['lives' => $lives]);
                } else {
                    $user->lessons()->updateExistingPivot($lesson->id, ['lives' => $lives]);
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Wrong answer',
                    'correct_answer' => $correct_answer,
                    'lives' => $lives
                ], 200);
            }
        }
    }

    public function findLastLessonByTopicId($id)
    {
        $lesson = Lesson::where('topic_id', $id)->orderBy('id', 'desc')->first();
        return $lesson;
    }
}
