<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $curPage = $request->input('cur_page', 1);
        $perPage = $request->input('per_page', 10);

        if ($status == null) {
            $lessons = Lesson::paginate($perPage, ['*'], 'page', $curPage);
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
            'image' => 'nullable|string'
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

        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'topic_id' => $request->topic_id,
            'image' => $request->image ?? null,
        ]);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Create lesson failed',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Create lesson successfully',
            'lesson' => $lesson
        ], 200);
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
        $result = Lesson::with('vocabularies.word', 'vocabularies.questions', 'vocabularies.word.means')
            ->find($id);
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
