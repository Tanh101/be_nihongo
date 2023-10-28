<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store;
use App\Http\Requests\StoreTopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function create_topic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Topic could not be created',
                'errors' => $validator->errors()
            ], 400);
        }

        $topic = Topic::create([
            'name' => $request->name,
            'image' => $request->image ?? 'demo',
            'description' => $request->description
        ]);

        if ($topic) {
            return response()->json([
                'message' => 'Topic created successfully',
                'topic' => $topic
            ], 201);
        }

        return response()->json([
            'message' => 'Topic could not be created'
        ], 400);
    }

    public function get_all_topics()
    {
        $topics = Topic::all()->where('deleted_at', null);

        if ($topics) {
            return response()->json([
                'message' => 'Topics retrieved successfully',
                'topics' => $topics
            ], 200);
        }

        return response()->json([
            'message' => 'Topics could not be retrieved'
        ], 400);
    }

    public function get_topic($id)
    {
        $topic = Topic::find($id)->where('deleted_at', null);

        if ($topic) {
            return response()->json([
                'message' => 'Topic retrieved successfully',
                'topic' => $topic
            ], 200);
        }

        return response()->json([
            'message' => 'Topic could not be retrieved'
        ], 400);
    }

    public function update_topic(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:topics',
            'description' => 'required|string|max:255',
            'image' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Topic could not be updated',
                'errors' => $validator->errors()
            ], 400);
        }

        $topic = Topic::find($id);

        if ($topic) {
            $topic->update([
                'name' => $request->name,
                'image' => $request->image ?? 'demo',
                'description' => $request->description
            ]);

            return response()->json([
                'message' => 'Topic updated successfully',
                'topic' => $topic
            ], 200);
        }

        return response()->json([
            'message' => 'Topic could not be updated'
        ], 400);
    }

    public function delete_topic($id)
    {
        $topic = Topic::find($id);

        if ($topic) {
            $topic->delete();

            return response()->json([
                'message' => 'Topic deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Topic could not be deleted'
        ], 400);
    }
}
