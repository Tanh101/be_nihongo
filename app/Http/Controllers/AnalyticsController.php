<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Lesson;
use App\Models\Topic;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function getAnalytics(Request $request)
    {
        $limit = $request->limit ?? 5;
        $total = [
            'total_users' => User::count(),
            'total_lessons' => Lesson::count(),
            'total_topics' => Topic::count(),
            'total_words' => Word::count(),
        ];

        $newlyRegisterUser = User::all()->sortByDesc('created_at')->take($limit)->values();
        $newlyTopics = Topic::all()->sortByDesc('created_at')->take($limit)->values();
        $newlyWords = Word::all()->sortByDesc('created_at')->take($limit)->values();
        $newlyLessons = Lesson::all()->sortByDesc('created_at')->take($limit)->values();

        $results = [
            'total' => $total,
            'newlyRegisterUser' => $newlyRegisterUser,
            'newlyTopics' => $newlyTopics,
            'newlyWords' => $newlyWords,
            'newlyLessons' => $newlyLessons,
        ];

        if ($results) {
            return response()->json([
                'status' => 200,
                'message' => 'Get analytics successfully',
                'results' => $results,
            ], 200);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Get analytics failed',
        ], 500);
    }
}
