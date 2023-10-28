<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function get_all_lessons()
    {
        $lessons = Lesson::all()->where('deleted_at', null);
        if ($lessons->count() == 0) {
            return response()->json([
                'success' => false,
                'message' => 'No lessons found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all lessons successfully',
            'lessons' => $lessons
        ], 200);
    }

    public function get_lesson_by_id($id)
    {
        $lesson = Lesson::find($id)->where('deleted_at', null);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get lesson successfully',
            'lesson' => $lesson
        ], 200);
    }

    public function create_lesson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Create lesson failed',
                'data' => $validator->errors()
            ], 400);
        }
        $lesson = Lesson::create([
            'title' => $request->name,
            'description' => $request->description,
            'topic_id' => $request->topic_id,
            'image' => $request->image ?? null,
            'status' => "active"
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
        ], 201);
    }

    public function update_lesson(Request $request)
    {
        $validator = Validator::make([
            'title' => $request->name,
            'description' => $request->description,
            'topic_id' => $request->topic_id
        ]);

        if ($validator->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Update lesson failed',
                'data' => $validator->errors()
            ], 400);
        }

        $lesson = Lesson::find($request->id)->where('deleted_at', null);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
                'data' => null
            ], 404);
        }

        $lesson->update([
            'title' => $request->name,
            'description' => $request->description,
            'topic_id' => $request->topic_id,
            'image' => $request->image ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Update lesson successfully',
            'lesson' => $lesson
        ], 200);
    }

    public function delete_lesson(Request $request)
    {
        $lesson = Lesson::find($request->id)->where('deleted_at', null);

        if (!$lesson) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson not found',
                'data' => null
            ], 404);
        }

        $lesson->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete lesson successfully',
            'lesson' => $lesson
        ], 200);
    }
}
