<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/topics",
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
     *     path="/api/topics",
     *     summary="Get all topics with lessons",
     *     tags={"Topics"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="200", description="Get topics successfully"),
     *     @OA\Response(response="500", description="Server error"),
     *     @OA\Response(response="404", description="Topics not found"),
     * )
     */
    public function get_all_topics()
    {
        $topics = Topic::with('lessons')
            ->where('deleted_at', null)
            ->get();

        if ($topics) {
            return response()->json([
                'suscess' => 'true',
                'message' => 'Get topics successfully',
                'topics' => $topics
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

    /**
     * @OA\Get(
     *     path="/api/topics/{id}",
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
     *     path="/api/topics/{id}",
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
     *     path="/api/topics/{id}",
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
}
