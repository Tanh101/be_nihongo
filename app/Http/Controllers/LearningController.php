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

        //check if lesson is first lesson in first topic
        $firstTopic = Topic::orderBy('id', 'asc')->first();
        if ($lessonWithId->topic_id == $firstTopic->id) {
            $firstLesson = Lesson::where('topic_id', $firstTopic->id)->orderBy('id', 'asc')->first();
            if ($firstLesson->id == $lessonWithId->id) {
                if (count($user->lessons()->wherePivot('lesson_id', $lessonWithId->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                    $user->lessons()->attach($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
                } else {
                    if (count($user->lessons()
                        ->wherePivot('status', 'finished')
                        ->wherePivot('lesson_id', $lessonWithId->id)
                        ->wherePivot('user_id', $user->id)
                        ->get()) == 0)
                        $user->lessons()->updateExistingPivot($lessonWithId->id, ['status' => 'unlocked', 'lives' => 3]);
                    else {
                        $user->lessons()->updateExistingPivot($lessonWithId->id, ['lives' => 3]);
                    }
                }
                return response()->json([
                    'success' => true,
                    'message' => 'You have unlocked this lesson',
                    'lesson' => $lessonWithId
                ], 200);
            }
        }

        //not first lesson in first topic
        if (!$user->lessons->contains($lessonWithId)) {
            return response()->json([
                'success' => false,
                'message' => 'You have not finished previous lesson',
            ], 400);
        }

        //if user has not unlocked this lesson
        if (count($user->lessons()->wherePivot('lesson_id', $lessonWithId->id)->wherePivot('user_id', $user->id)->get()) != 0) {
            if (count($user->lessons()
                ->wherePivot('lesson_id', $lessonWithId->id)
                ->wherePivot('user_id', $user->id)
                ->wherePivot('status', 'finished')
                ->get()) != 0)
                $user->lessons()->updateExistingPivot($lessonWithId->id, ['lives' => 3]);
            else
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
        $unlocked = "unlocked";
        $finished = "finished";
        $choice = "choice";
        $writing = "writing";

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

        //find question
        $quesId = (int) $request->question_id;
        $question = Question::find($quesId);

        if (!$question) {
            return response()->json([
                'success' => false,
                'message' => 'Question not found'
            ], 404);
        }

        //find lesson
        $lessonIdRequest = Vocabulary::where('id', $question->vocabulary_id)->first()->lesson_id;
        if ($lessonIdRequest != $id) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
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
        if (!count($user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
            $lives = $user->lessons()->wherePivot('lesson_id', $lesson->id)->wherePivot('user_id', $user->id)->first()->pivot->lives;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You have not unlocked this lesson'
            ], 400);
        }

        $yourAnswer = $request->answer;

        if ($question->type === $choice) {
            $correct_answer = (string) $correct_answer->id;
        } else {
            $correct_answer = $correct_answer->content;
        }

        if ($isFinalQuestion) {
            if ($yourAnswer === $correct_answer) {
                //update status to finished

                //if current is finished => do nothing
                if ($this->getCurrentStatus($lesson->id) == $finished) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Correct answer',
                        'correct_answer' => $correct_answer,
                        'lives' => $lives
                    ], 200);
                } else if ($this->getCurrentLives($lesson->id) >= 1) {
                    $this->setPivotLessonUser($lesson->id, $finished, 3, true);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'You must learn this lesson again because you have no lives',
                        'lives' => $lives
                    ], 400);
                }

                //unlocked next lesson
                $lastLessonInTopic = $this->findLastLessonByTopicId($lesson->topic_id);

                //check if lesson is not last lesson in topic => unlocked next lesson
                if ($lastLessonInTopic->id != $lesson->id) {
                    $nextLesson = Lesson::where('topic_id', $lesson->topic_id)->where('id', '>', $lesson->id)->first();
                    if ($nextLesson) {
                        if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                            $user->lessons()->attach($nextLesson->id, ['status' => $unlocked, 'lives' => 3]);
                        } else {
                            $user->lessons()->updateExistingPivot($nextLesson->id, ['lives' => 3]);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Next lesson not found',
                            'lives' => $lives
                        ], 404);
                    }

                    // check if lesson is last lesson in topic => unlocked next topic
                } else {
                    $nextTopic = Topic::where('id', '>', $lesson->topic_id)->first();
                    if ($nextTopic) {
                        $nextLesson = Lesson::where('topic_id', $nextTopic->id)->first();
                        if ($nextLesson) {
                            if (count($user->lessons()->wherePivot('lesson_id', $nextLesson->id)->wherePivot('user_id', $user->id)->get()) == 0) {
                                $user->lessons()->attach($nextLesson->id, ['status' => 'unlocked', 'lives' => 3]);
                            } else {
                                $user->lessons()->updateExistingPivot($nextLesson->id, ['lives' => 3]);
                            }
                        } else {
                            return response()->json([
                                'success' => false,
                                'message' => 'Next lesson not found',
                                'lives' => $lives
                            ], 404);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Next topic not found',
                            'lives' => $lives
                        ], 404);
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
            }
        } else {
            if ($yourAnswer === $correct_answer) {
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
            }
        }

        $user->lessons()->updateExistingPivot($lesson->id, ['lives' => $lives]);

        return response()->json([
            'success' => true,
            'message' => 'Wrong answer',
            'correct_answer' => $correct_answer,
            'lives' => $lives
        ], 200);
    }

    public function findLastLessonByTopicId($id)
    {
        $lesson = Lesson::where('topic_id', $id)->orderBy('id', 'desc')->first();
        return $lesson;
    }

    public function setPivotLessonUser($lesson_id, $status, $lives, $isUpdate)
    {
        $user = Auth::user();

        if ($isUpdate) {
            $user->lessons()->updateExistingPivot($lesson_id, ['status' => $status, 'lives' => $lives]);
        } else {
            $user->lessons()->attach($lesson_id, ['status' => $status, 'lives' => $lives]);
        }
    }
    public function getCurrentLives($lesson_id)
    {
        $user = Auth::user();

        $lives = $user->lessons()->wherePivot('lesson_id', $lesson_id)->wherePivot('user_id', $user->id)->first()->pivot->lives;
        return $lives;
    }

    public function getCurrentStatus($lesson_id)
    {
        $user = Auth::user();

        $status = $user->lessons()->wherePivot('lesson_id', $lesson_id)->wherePivot('user_id', $user->id)->first()->pivot->status;
        return $status;
    }
}
