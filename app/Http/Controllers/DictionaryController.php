<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Mean;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;
use function PHPUnit\Framework\isEmpty;

class DictionaryController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/dashboard/dictionaries",
     *      tags={"Dictionary"},
     *      summary="Create new dictionary",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *          required={"dictionaries"},
     *          @OA\Property(
     *            property="dictionaries",
     *            type="array",
     *            @OA\Items(
     *              type="object",
     *              required={"word", "sino_vietnamese", "pronunciation", "means"},
     *              @OA\Property(
     *                property="word",
     *                type="string",
     *                description="Word",
     *                example="突く"
     *              ),
     *              @OA\Property(
     *                property="pronunciation",
     *                type="string",
     *                description="Pronunciation",
     *                example="つく"
     *              ),
     *              @OA\Property(
     *                property="sino_vietnamese",
     *                type="string",
     *                description="Sino Vietnamese",
     *                example="ĐỘT"
     *              ),
     *              @OA\Property(
     *                property="means",
     *                type="array",
     *                @OA\Items(
     *                  type="object",
     *                  required={"meaning"},
     *                  @OA\Property(
     *                      property="meaning",
     *                      type="string",
     *                      description="Meaning",
     *                      example="đâm"
     *                  ),
     *                  @OA\Property(
     *                      property="example",
     *                      type="string",
     *                      description="Example",
     *                      example="ファークで肉を突く。"
     *                  ),
     *                  @OA\Property(
     *                      property="example_meaning",
     *                      type="string",
     *                      description="Example Meaning",
     *                      example="Dùng dao đâm vào thịt"
     *                  ),
     *                ),
     *              ),
     *            ),
     *          ),
     *        ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Create dictionary success",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server errror",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Validation error",
     *      ),
     *     )
     */
    public function createDictionary(Request $request)
    {
        $dictionaryArray = [];
        $validator = Validator::make($request->all(), [
            'dictionaries' => 'required|array',
            'dictionaries.*.word' => 'required|string|unique:words',
            'dictionaries.*.pronunciation' => 'required|string',
            'dictionaries.*.sino_vietnamese' => 'string',
            'dictionaries.*.means' => 'required|array',
            'dictionaries.*.means.*.meaning' => 'required|string',
            'dictionaries.*.means.*.example' => 'string',
            'dictionaries.*.means.*.example_meaning' => 'string',
            'dictionaries.*.means.*.image' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }


        $dictionaries = $request->input('dictionaries');
        foreach ($dictionaries as $dictionary) {
            $newWord = Word::create([
                'word' => $dictionary['word'],
                'pronunciation' => $dictionary['pronunciation'],
                'sino_vietnamese' => $dictionary['sino_vietnamese'] ?? null,
                'image' => $dictionary['image'] ?? null,
            ]);

            if (!$newWord) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create word'
                ], 500);
            }

            $means = $dictionary['means'];
            foreach ($means as $mean) {
                Mean::create([
                    'meaning' => $mean['meaning'],
                    'word_id' => $newWord->id,
                    'example' => $mean['example'] ?? null,
                    'example_meaning' => $mean['example_meaning'] ?? null,
                    'image' => $mean['image'] ?? null,
                ]);
            }

            array_push($dictionaryArray, $newWord->load('means'));
        }

        return response()->json([
            'status' => 'success',
            'dictionaries' => $dictionaryArray
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/dictionaries",
     *     summary="Search a list of words",
     *     tags={"Dictionary"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *       name="word",
     *       in="query",
     *       description="Word",
     *       example="突"
     *     ),
     *     @OA\Response(
     *      response="200",
     *      description="Successful operation",
     *      @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="status", type="string", example="success"),
     *         @OA\Property(property="words", type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=11),
     *                 @OA\Property(property="word", type="string", example="突く"),
     *                 @OA\Property(property="pronunciation", type="string", example="つく"),
     *                 @OA\Property(property="sino_vietnamese", type="string", example="ĐỘT"),
     *                 @OA\Property(property="deleted_at", type="string", format="date-time", nullable=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-15T07:17:19.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-15T07:17:19.000000Z"),
     *                 @OA\Property(property="means", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example=11),
     *                         @OA\Property(property="word_id", type="integer", example=11),
     *                         @OA\Property(property="meaning", type="string", example="đâm"),
     *                         @OA\Property(property="example", type="string", example="ファークで肉を突く。"),
     *                         @OA\Property(property="example_meaning", type="string", example="Dùng dao đâm vào thịt"),
     *                         @OA\Property(property="image", type="string", nullable=true),
     *                         @OA\Property(property="created_at", type="string", format="date-time", example="2023-11-15T07:17:19.000000Z"),
     *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2023-11-15T07:17:19.000000Z"),
     *                     ),
     *                 ),
     *             ),
     *         ),
     *       ),
     *     ),
     *     @OA\Response(
     *       response="404",
     *       description="Word not found",
     *     ),
     * )
     */
    public function searchDictionaryByWord(Request $request)
    {
        $resultWords = [];
        $word = $request->query('word');
        $limit = $request->query('limit') ?? 5;
        if (!$word)
            $words = Word::with('means')->limit($limit)->get();
        else
            $words = Word::where('word', 'like', '%' . $word . '%')->with('means')->limit($limit)->get();
        foreach ($words as $word) {
            $resultWords[] = [
                'id' => $word->id,
                'word' => $word->word,
                'pronunciation' => $word->pronunciation,
                'sino_vietnamese' => $word->sino_vietnamese,
                'means' => $word->means->isNotEmpty() ? [$word->means->first()] : [],
            ];
        }
        if (!$resultWords) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'words' => $resultWords
        ], 200);
    }

    public function searchWordToCreateLesson(Request $request)
    {
        $resultWords = [];
        $word = $request->query('word');
        $limit = $request->query('limit') ?? 5;
        if (!$word) {
            $words = DB::table('words')
                ->leftJoin('vocabularies', 'words.id', '=', 'vocabularies.word_id')
                ->join('means', 'words.id', '=', 'means.word_id')
                ->whereNull('vocabularies.word_id')
                ->select('words.*') // Select columns from both tables
                ->limit($limit)
                ->get();
        } else {
            $words = DB::table('words')
                ->leftJoin('vocabularies', 'words.id', '=', 'vocabularies.word_id')
                ->join('means', 'words.id', '=', 'means.word_id')
                ->whereNull('vocabularies.word_id')
                ->where('words.word', 'like', '%' . $word . '%')
                ->select('words.*')
                ->limit($limit)
                ->get();
        }

        if (!$words) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'words' => $words
        ], 200);
    }

    /**
     * @OA\Put(
     *      path="/api/dashboard/dictionaries/{id}",
     *      tags={"Dictionary"},
     *      summary="Edit dictionary",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          example=1,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"word", "means", "pronunciation", "sino_vietnamese"},
     *              @OA\Property(
     *                property="word",
     *                type="string",
     *                description="Word",
     *                example="解く"
     *              ),
     *              @OA\Property(
     *                property="pronunciation",
     *                type="string",
     *                description="Pronunciation",
     *                example="ほどく"
     *              ),
     *              @OA\Property(
     *                property="sino_vietnamese",
     *                type="string",
     *                description="Sino Vietnamese",
     *                example = "GIẢI"
     *              ),
     *              @OA\Property(
     *                property="means",
     *                type="array",
     *                @OA\Items(
     *                type="object",
     *                required={"id", "meaning"},
     *                @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="Mean id",
     *                      example=2
     *                ),
     *                @OA\Property(
     *                      property="meaning",
     *                      type="string",
     *                      description="meaning",
     *                      example="mở ra"
     *                ),
     *                @OA\Property(
     *                      property="example",
     *                      type="string",
     *                      description="Example",
     *                      example="靴の紐を解けた。"
     *                ),
     *                @OA\Property(
     *                      property="example_meaning",
     *                      type="string",
     *                      description="Example Meaning",
     *                      example="Mở dây giày"
     *                ),
     *                @OA\Property(
     *                      property="image",
     *                      type="string",
     *                      description="Image",
     *                      example="https://i.imgur.com/1.jpg"
     *                ),
     *              )
     *            ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Edit dictionary success",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server errror",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Validation error",
     *       ),
     *     )
     */
    public function updateDictionary(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'word' => 'string|required',
            'pronunciation' => 'string|required',
            'sino_vietnamese' => 'string',
            'means' => 'array|required',
            'means.*.id' => 'required',
            'means.*.meaning' => 'string|required',
            'means.*.example' => 'string',
            'means.*.example_meaning' => 'string',
            'means.*.image' => 'string',
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $word = Word::find($id);
        if (!$word) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        $word->word = $request->input('word');
        $word->pronunciation = $request->input('pronunciation');
        $word->sino_vietnamese = $request->input('sino_vietnamese') ?? $word->sino_vietnamese;
        $word->save();

        $means = $request->input('means');
        foreach ($means as $item) {
            $mean = Mean::find($item['id']);
            if (!$mean) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mean not found'
                ], 404);
            }
            $mean->meaning = $item['meaning'];
            $mean->example = $item['example'] ?? $mean->example;
            $mean->example_meaning = $item['example_meaning'] ?? $mean->example_meaning;
            $mean->image = $item['image'] ?? $mean->image;
            $mean->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Edit dictionary success',
            'word' => $word->load('means')
        ], 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/dashboard/dictionaries/{id}",
     *      tags={"Dictionary"},
     *      description="Delete dictionary",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          example=1,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Delete dictionary success",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Word not found",
     *       ),@OA\Response(
     *          response=500,
     *          description="Server error",
     *       ),
     *     )
     */
    public function deleteDictionary($id)
    {
        $word = Word::find($id);
        if (!$word) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Word not found'
            ], 404);
        }

        $word->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete dictionary successfully'
        ], 200);
    }

    public function getAllDictionaries(Request $request)
    {
        $resultWords = [];
        $perPage = $request->query('per_page') ?? 10;
        $curPage = $request->query('cur_page') ?? 1;
        $word = $request->word;

        $words = Word::where('word', 'like', '%' . $word . '%')->with('means')->paginate($perPage, ['*'], 'page', $curPage);
        foreach ($words as $word) {
            $resultWords[] = [
                'id' => $word->id,
                'word' => $word->word,
                'pronunciation' => $word->pronunciation,
                'sino_vietnamese' => $word->sino_vietnamese,
                'means' => $word->means->isNotEmpty() ? [$word->means->first()] : [],
            ];
        }
        if (!$resultWords) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        $totalPages = ceil($words->total() / $perPage);
        $pagination = [
            'per_page' => $words->perPage(),
            'current_page' => $words->currentPage(),
            'total_pages' => $totalPages,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Get dictionaries successfully',
            'total_result' => $words->total(),
            'pagination' => $pagination,
            'dictionaries' => $resultWords
        ], 200);
    }
}
