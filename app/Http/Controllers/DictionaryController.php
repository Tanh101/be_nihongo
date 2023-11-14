<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use App\Repositories\Dictonary\DictionaryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class DictionaryController extends Controller
{
    public $dictionaryRepository;

    public function __construct(
        DictionaryRepository $dictionaryRepository
    ) {
        $this->dictionaryRepository = $dictionaryRepository;
    }

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
     *              required={"word", "meaning", "pronunciation"},
     *              @OA\Property(
     *                property="word",
     *                type="string",
     *                description="Word"
     *              ),
     *              @OA\Property(
     *                property="pronunciation",
     *                type="string",
     *                description="Pronunciation"
     *              ),
     *              @OA\Property(
     *                property="sino_vietnamese",
     *                type="string",
     *                description="Sino Vietnamese"
     *              ),
     *              @OA\Property(
     *                property="means",
     *                type="array",
     *                description="Means"
     *                @OA\Items(
     *                  type="object",
     *                  required={"meaning", "example", "example_meaning"},
     *                  @OA\Property(
     *                      property="mean",
     *                      type="string",
     *                      description="Word"
     *                  ),
     *                ),
     *              ),
     *              @OA\Property(
     *                property="example",
     *                type="string",
     *                description="Example"
     *              ),@OA\Property(
     *                property="exampple_meaning",
     *                type="string",
     *                description="Example Meaning"
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
            'dictionaries.*.word' => 'required|string',
            'dictionaries.*.pronunciation' => 'required|string',
            'dictionaries.*.sino_vietnamese' => 'string',
            'dictionary.*.word.means' => 'required|array',
            'dictionaries.*.word.means.*.meaning' => 'required|string',
            'dictionaries.*.word.means.*.example' => 'string',
            'dictionaries.*.word.means.*.example_meaning' => 'string',
            'dictionaries.*.word.means.*.image' => 'string',
        ]);

        if ($validator->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $dictionaryArray = $this->dictionaryRepository->createDictionary($request->input('dictionaries'));

        return response()->json([
            'status' => 'success',
            'dictionaries' => $dictionaryArray
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/dictionaries/{word}",
     *     summary="Search a list of words",
     *     tags={"Dictionary"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *       name="word",
     *       in="path",
     *       required=true,
     *       description="Word",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="List of words",
     *         @OA\JsonContent(
     *          @OA\Property(
     *              property="words",
     *              title="words",
     *              type="array",
     *              @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="word", type="string"),
     *                 @OA\Property(property="pronunciation", type="string"),
     *                 @OA\Property(property="meaning", type="string"),
     *                 @OA\Property(property="image", type="string", nullable=true),
     *                 @OA\Property(property="deleted_at", type="string", nullable=true),
     *                 @OA\Property(property="created_at", type="string"),
     *                 @OA\Property(property="updated_at", type="string"),
     *                 @OA\Property(
     *                     property="dictionary",
     *                     type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="word_id", type="integer"),
     *                     @OA\Property(property="deleted_at", type="string", nullable=true),
     *                     @OA\Property(property="created_at", type="string"),
     *                     @OA\Property(property="updated_at", type="string"),
     *                     @OA\Property(property="example", type="string"),
     *                     @OA\Property(property="example_meaning", type="string"),
     *                 ),
     *             ),
     *           ),
     *         ),
     *     ),
     *     @OA\Response(
     *       response="404",
     *       description="Word not found",
     *     ),
     * )
     */
    public function searchDictionaryByWord($word)
    {
        $words = Word::where('word', 'like', '%' . $word . '%')->with('dictionary')->get();
        if (isEmpty($words)) {
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
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"word", "meaning", "pronunciation"},
     *              @OA\Property(
     *                property="word",
     *                type="string",
     *                description="Word"
     *              ),
     *              @OA\Property(
     *                property="pronunciation",
     *                type="string",
     *                description="Pronunciation"
     *              ),
     *              @OA\Property(
     *                property="meaning",
     *                type="string",
     *                description="Meaning"
     *              ),
     *              @OA\Property(
     *                property="example",
     *                type="string",
     *                description="Example"
     *              ),@OA\Property(
     *                property="example_meaning",
     *                type="string",
     *                description="Example Meaning"
     *              ),
     *            ),
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
            'meaning' => 'string|required',
            'pronunciation' => 'string',
            'example' => 'string|max:255',
            'example_meaning' => 'string|max:255',
            'image' => 'string',
        ]);
        if ($validator->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $dictionary = Dictionary::find($id);
        if (!$dictionary) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dictionary not found'
            ], 404);
        }

        $word = Word::find($dictionary->word_id);
        if (!$word) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        $word->word = $request->input('word') ?? $word->word;
        $word->meaning = $request->input('meaning') ?? $word->meaning;
        $word->pronunciation = $request->input('pronunciation') ?? $word->pronunciation;
        $word->image = $request->input('image') ?? $word->image;
        $word->save();

        $dictionary->example = $request->input('example') ?? $dictionary->example;
        $dictionary->example_meaning = $request->input('example_meaning') ?? $dictionary->example_meaning;
        $dictionary->save();

        return response()->json([
            'status' => 'success',
            'dictionary' => $dictionary->load('word')
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
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Delete dictionary success",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Dictionary not found",
     *       ),@OA\Response(
     *          response=500,
     *          description="Server error",
     *       ),
     *     )
     */
    public function deleteDictionary($id)
    {
        $dictionary = Dictionary::find($id);
        if (!$dictionary) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dictionary not found'
            ], 404);
        }

        $word = Word::find($dictionary->word_id);
        if (!$word) {
            return response()->json([
                'status' => 'error',
                'message' => 'Word not found'
            ], 404);
        }

        $dictionary->delete();
        $word->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete dictionary success'
        ], 200);
    }
}
