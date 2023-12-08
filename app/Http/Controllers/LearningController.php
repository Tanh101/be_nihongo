<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
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

        $lesson = Lesson::where('id', $id)->get()->first();

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
            ], 404);
        }

        $lessonsInTopic = Lesson::where('topic_id', $lesson->topic_id)->get();
        if (!$lessonsInTopic) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
            ], 404);
        }

        $firstLesson = $lessonsInTopic[0];
        $previousLessonId = -1;

        for ($i = 0; $i < count($lessonsInTopic); $i++) {
            if ($lessonsInTopic[$i]->id == $lesson->id) {
                if ($i > 0) {
                    $previousLessonId = $lessonsInTopic[$i - 1]->id;
                }
                break;
            }
        }
        if ($previousLessonId == -1) {
            $previousLessonId = $firstLesson->id;
        }
        $previousLesson = Lesson::where('id', $previousLessonId)->get()->first();

        if ($previousLesson && $previousLesson->id != $lesson->id) {
            if (!$user->lessons->contains($previousLesson)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have not finished previous lesson',
                ], 400);

                if ($user->lessons->where('id', $previousLesson->id)->first()->pivot->status != 'finished') {
                    return response()->json([
                        'success' => false,
                        'message' => 'You have not finished previous lesson'
                    ], 400);
                }
            }
        }

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found'
            ], 404);
        }

        $status = 'unlocked';
        $lives = 3;
        if (!$user->lessons->contains($lesson)) {
            $user->lessons()->sync([$lesson->id => ['status' => $status, 'lives' => $lives]]);
        } else {
            $user->lessons()->updateExistingPivot($lesson->id, ['status' => $status, 'lives' => $lives]);
        }

        return response()->json([
            'success' => true,
            'message' => 'You have unlocked this lesson',
            'lesson' => $lesson
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
     *              @OA\Property(property="question_id", type="integer", example=1),
     *              @OA\Property(property="answer", type="string", example="answer"),
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
            'question_id' => 'required|integer',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields',
                'errors' => $validator->errors()
            ], 400);
        }

        $question = Question::find($request->question_id);
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
        $correct_answer = $question->answers->where('is_correct', 1)->first()->content;

        //check if question is final question ---- missing ------------------
        $lives = $user->lessons->where('id', $id)->first()->pivot->lives;
        if ($request->answer === $correct_answer) {
            return response()->json([
                'success' => true,
                'message' => 'Correct answer',
                'correct_answer' => $correct_answer,
                'lives' => $lives
            ], 200);
        } else {
            if ($lives > 1) {
                $lives -= 1;
            }
            $user->lessons()->updateExistingPivot($id, ['lives' => $lives]);
            return response()->json([
                'success' => true,
                'message' => 'Wrong answer',
                'correct_answer' => $correct_answer,
                'lives' => $lives
            ], 200);
        }
    }
}
