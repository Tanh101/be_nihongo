<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/dashboard/topics",
     *     summary="Create a new topic",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name"
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
     *         )
     *     ),
     *     @OA\Response(response="200", description="Create topic successfully"),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(response="500", description="Server error"),
     * )
     */
    public function create_topic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics',
            'description' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'suscess' => 'false',
                'message' => 'Topic could not be created',
                'errors' => $validator->errors()
            ], 400);
        }

        $topic = Topic::create([
            'name' => $request->name,
            'image' => $request->image ?? null,
            'description' => $request->description
        ]);

        if ($topic) {
            return response()->json([
                'suscess' => 'true',
                'message' => 'Topic created successfully',
                'topic' => $topic
            ], 200);
        }

        return response()->json([
            'suscess' => 'false',
            'message' => 'Server error'
        ], 500);
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/topics/{id}",
     *     summary="Get a topic by ID",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the topic",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get topic successfully"),
     *     @OA\Response(response="404", description="Topic not found"),
     *     @OA\Response(response="500", description="Server error"),
     * )
     */
    public function get_topic()
    {
        $id = request()->id;
        $topic = Topic::with('lessons')->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        if ($topic) {
            return response()->json([
                'success' => 'true',
                'message' => 'Get Topic successfully',
                'topic' => $topic,
            ], 200);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Topic could not be retrieved'
            ], 404);
        }

        return response()->json([
            'success' => 'false',
            'message' => 'Server error'
        ], 500);
    }

    /**
     * @OA\Put(
     *     path="/api/dashboard/topics/{id}",
     *     summary="Update a topic by ID",
     *     tags={"Topics"},
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name"
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
     *     @OA\Response(response="200", description="Update topic successfully"),
     *     @OA\Response(response="404", description="Topic not found"),
     *     @OA\Response(response="500", description="Server error"),
     * )
     */
    public function update_topic(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics',
            'description' => 'required|string|max:255',
            'image' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        $topic = Topic::find($id);

        if ($topic) {
            $topic->update([
                'name' => $request->name,
                'image' => $request->image ?? null,
                'description' => $request->description
            ]);

            return response()->json([
                'success' => 'true',
                'message' => 'Topic updated successfully',
                'topic' => $topic
            ], 200);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Topic not found'
            ], 404);
        }

        return response()->json([
            'success' => 'false',
            'message' => 'Server error'
        ], 500);
    }

    /**
     * @OA\Delete(
     *     path="/api/dashboard/topics/{id}",
     *     summary="Delete a topic by ID",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the topic",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get topic successfully"),
     *     @OA\Response(response="404", description="Topic not found"),
     *     @OA\Response(response="500", description="Server error"),
     *)
     */
    public function delete_topic($id)
    {
        $topic = Topic::find($id);

        if ($topic) {
            $topic->delete();

            return response()->json([
                'success' => 'true',
                'message' => 'Topic deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Topic not found'
            ], 404);
        }

        return response()->json([
            'success' => 'false',
            'message' => 'Server error'
        ], 400);
    }

    //dashboard

    /**
     * @OA\Get(
     *     path="/api/dashboard/topics",
     *     summary="Get all topics by admin",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"deleted"},
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
     *     @OA\Response(response="200", description="Get topics successfully"),
     *     @OA\Response(response="500", description="Server error"),
     *     @OA\Response(response="404", description="Topics not found"),
     * )
     */
    public function get_all_topics_by_admin(Request $request)
    {
        $status = $request->status;
        $curPage = $request->input('cur_page', 1);
        $perPage = $request->input('per_page', 10);

        if ($status == null) {
            $topics = Topic::paginate($perPage, ['*'], 'page', $curPage);
        } else if ($status == 'deleted') {
            $topics = Topic::onlyTrashed()->paginate($perPage, ['*'], 'page', $curPage);
        }

        if ($topics->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No topics found',
            ], 404);
        }

        $totalPages = ceil($topics->total() / $perPage);
        $pagination = [
            'per_page' => $topics->perPage(),
            'current_page' => $topics->currentPage(),
            'total_pages' => $totalPages,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Get topics successfully',
            'total_result' => $topics->total(),
            'pagination' => $pagination,
            'topics' => $topics->items()
        ], 200);
    }

    /**
     * @OA\Patch(
     *     path="/api/dashboard/topics/{id}",
     *     summary="Restore a topic by ID",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the topic",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Restore topic successfully"),
     *     @OA\Response(response="404", description="Topic not found"),
     *     @OA\Response(response="500", description="Server error"),
     *)
     */
    public function restore_topic($id)
    {
        $topic = Topic::onlyTrashed()->find($id);

        if ($topic) {
            $topic->restore();

            return response()->json([
                'success' => 'true',
                'message' => 'Topic restored successfully',
                'topic' => $topic
            ], 200);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Topic not found'
            ], 404);
        }

        return response()->json([
            'success' => 'false',
            'message' => 'Server error'
        ], 500);
    }

    /**
     * @OA\Get(
     *     path="/api/topics",
     *     summary="Get all topics with lessons",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Get topics successfully",
     *          @OA\JsonContent(
     *          type="array",     
     *              @OA\Items(
     *              type="object",
     *                  @OA\Property(
     *                      property="topicId",
     *                      type="integer",
     *                      description="Topic ID"
     *                  ),
     *                  @OA\Property(
     *                      property="topicName",
     *                      type="string",
     *                      description="Topic name"
     *                  ),
     *                  @OA\Property(
     *                      property="topicImage",
     *                      type="string",
     *                      description="Topic image"
     *                  ),
     *                  @OA\Property(
     *                      property="lessons",
     *                      type="array",
     *                      description="Lessons",
     *                      @OA\Items(
     *                          type="object",
     *                          @OA\Property(
     *                              property="lessonId",
     *                              type="integer",
     *                              description="Lesson ID"
     *                          ),
     *                          @OA\Property(
     *                              property="lessonTitle",
     *                              type="string",
     *                              description="Lesson title"
     *                          ),
     *                          @OA\Property(
     *                              property="lessonDescription",
     *                              type="string",
     *                              description="Lesson description"
     *                          ),
     *                          @OA\Property(
     *                              property="lessonImage",
     *                              type="string",
     *                              description="Lesson image"
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              description="Status"
     *                         ),
     *                      ),
     *                 ),
     *             ),
     *        ),
     * ),
     *     @OA\Response(response="500", description="Server error"),
     *     @OA\Response(response="404", description="Topics not found"),
     * )
     */
    public function get_all_topics_by_user()
    {
        $userId = auth()->user()->id;

        $result = DB::table('topics')
            ->select(
                'topics.id as topicId',
                'topics.name as topicName',
                'topics.image as topicImage',
                'lessons.id as lessonId',
                'lessons.title as lessonTitle',
                'lessons.description as lessonDescription',
                'lessons.image as lessonImage',
                'lesson_user.status'
            )
            ->leftJoin('lessons', 'topics.id', '=', 'lessons.topic_id')
            ->leftJoin('lesson_user', function ($join) use ($userId) {
                $join->on('lessons.id', '=', 'lesson_user.lesson_id')
                    ->where('lesson_user.user_id', $userId);
            })
            ->get();

        $topicsWithLessons = collect($result)->groupBy('topicId')->map(function ($items) {
            $firstItem = $items->first();
            return [
                'topicId' => $firstItem->topicId,
                'topicName' => $firstItem->topicName,
                'topicImage' => $firstItem->topicImage,
                'lessons' => $items->map(function ($item) {
                    return [
                        'lessonId' => $item->lessonId,
                        'lessonTitle' => $item->lessonTitle,
                        'lessonDescription' => $item->lessonDescription,
                        'lessonImage' => $item->lessonImage,
                        'status' => $item->status,
                    ];
                })->all(),
            ];
        })->values()->all();
        
        if ($topicsWithLessons) {
            return response()->json([
                'suscess' => 'true',
                'message' => 'Get topics successfully',
                'topics' => $topicsWithLessons
            ], 200);
        } else {
            return response()->json([
                'suscess' => 'false',
                'message' => 'Topics not found'
            ], 500);
        }

        return response()->json([
            'suscess' => 'false',
            'message' => 'Server error'
        ], 500);
    }
}
