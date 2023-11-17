<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/words/{word}",
     *      tags={"Word"},
     *      description="Get word detail",
     *      security={{"bearerAuth":{}}}, 
     *      @OA\Parameter(
     *          description="Word",
     *          in="path",
     *          name="word",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Get word detail successfully",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Word not found",
     *       ),
     *     )
     */
    public function wordDetail($id)
    {
        $word = Word::with('means')->where('id', $id)->first();
        if (!$word) {
            return response()->json([
                'message' => 'Word not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Get word detail successfully',
            'data' => $word
        ], 200);
    }
}
