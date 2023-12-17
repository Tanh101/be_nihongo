<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlashcardController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/flashcard",
     *      tags={"Flashcard"},
     *      summary="Create flashcard",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="name",
     *                  description="Name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  description="Description",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="cards",
     *                  description="Cards",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="word",
     *                          type="string",
     *                          description="Word"
     *                      ),
     *                      @OA\Property(
     *                          property="definition",
     *                          type="string",
     *                          description="Definition"
     *                      ),
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Create Successfully",
     *       ),
     *     ),
     *   )
     */

    public function createFlashcard(Request $request)
    {
        $initialStatus = 'active';

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string|max:255',
            'cards' => 'required|array',
            'cards.*.word' => 'required|string|max:255',
            'cards.*.definition' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $flashcard = Flashcard::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $initialStatus,
            'user_id' => auth()->user()->id
        ]);

        if (!$flashcard) {
            return response()->json([
                'success' => false,
                'message' => 'Flashcard creation failed'
            ], 500);
        }

        $cards = $request->cards;
        foreach ($cards as $card) {
            $newCard = Card::create([
                'word' => $card['word'],
                'definition' => $card['definition'],
                'flashcard_id' => $flashcard->id
            ]);

            if (!$newCard) {
                return response()->json([
                    'success' => false,
                    'message' => 'Card creation failed'
                ], 500);
            }
        }

        return response()->json([
            'succes' => true,
            'message' => 'Flashcard created successfully',
            'flashcard' => $flashcard->load('cards')
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/flashcard/{id}",
     *      tags={"Flashcard"},
     *      summary="Get Cards by flashcard id",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Get cards successfully",
     *       ),
     *     )
     */
    public function getCardsByFlashcardID($id)
    {
        $flashcard = Flashcard::find($id);
        if (!$flashcard) {
            return response()->json([
                'success' => false,
                'message' => 'Flashcard not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get flashcard successfully',
            'flashcard' => $flashcard->load('cards')
        ], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/flashcard",
     *      tags={"Flashcard"},
     *      summary="Get all flashcard",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Get all flashcard successfully",
     *       ),
     *     )
     */
    public function getAllFlashcard()
    {
        $user = auth()->user();

        $flashcards = Flashcard::where('user_id', $user->id)->get();
        if (!$flashcards) {
            return response()->json([
                'success' => false,
                'message' => 'Get all flashcard failed',
            ]);
        }

        foreach ($flashcards as $flashcard) {
            $word_count = Card::where('flashcard_id', $flashcard->id)->count();
            $flashcard->word_count = $word_count;
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all flashcard successfully',
            'flashcards' => $flashcards
        ]);
    }

    /**
     * @OA\Put(
     *      path="/api/flashcard/{id}",
     *      tags={"Flashcard"},
     *      summary="Update flashcard",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *                 @OA\Property(
     *                     property="name",
     *                     description="Name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     description="Description",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="cards",
     *                     description="Cards",
     *                     type="array",
     *                     @OA\Items(
     *                          @OA\Property(
     *                              property="id",
     *                              type="string",
     *                              description="Card Id"
     *                          ),
     *                          @OA\Property(
     *                              property="word",
     *                              type="string",
     *                              description="Word"
     *                          ),
     *                          @OA\Property(
     *                              property="definition",
     *                              type="string",
     *                              description="Definition"
     *                          ),
     *                     ),
     *                 ),
     *                 
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Update successfully",
     *       ),
     *     )
     */
    public function updateFlashcard(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string|max:255',
            'cards' => 'required|array',
            'cards.*.id' => 'required|string|max:255',
            'cards.*.word' => 'required|string|max:255',
            'cards.*.definition' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $flashCard = Flashcard::find($id);

        if (!$flashCard) {
            return response()->json([
                'success' => false,
                'message' => 'Flashcard not found'
            ], 404);
        }

        if (!$this->isOwnerFlashcard($flashCard->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the owner of this flashcard'
            ], 403);
        }

        $affectedFlashcardRow = FlashCard::where('id', $flashCard->id)->update([
            'name' => $request->name ?? $flashCard->name,
            'description' => $request->description ?? $flashCard->description,
        ]);

        if ($affectedFlashcardRow === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Update flashcard error'
            ], 500);
        }

        $cards = $request->cards;
        foreach ($cards as $card) {
            $newCard = Card::find($card['id']);
            if (!$newCard) {
                return response()->json([
                    'success' => false,
                    'mesasge' => 'Card not found'
                ], 404);
            }

            $affectRows = Card::where('id', $newCard->id)
                ->update([
                    'word' => $card['word'] ?? $newCard->word,
                    'definition' => $card['definition'] ?? $newCard->definition
                ]);
            if ($affectRows === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Update card error'
                ], 500);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Update flashcard successfully',
            'flashcard' => $flashCard->load('cards')
        ], 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/flashcard/{id}",
     *      tags={"Flashcard"},
     *      summary="Delete flashcard by Id",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Card deleted successfully",
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Flashcard not found",
     *       ),
     *       @OA\Response(
     *          response=403,
     *          description="You are not the owner of this flashcard",
     *       ),
     *     )
     */
    public function deleteFlashcard($id)
    {

        $flashCard = Flashcard::find($id);
        if (!$flashCard) {
            return response()->json([
                'success' => false,
                'message' => 'Flashcard not found'
            ], 404);
        }

        if (!$this->isOwnerFlashcard($flashCard->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the owner of this flashcard'
            ], 403);
        }

        Flashcard::find($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delete flashcard successfully'
        ], 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/cards/{id}",
     *      tags={"Cards"},
     *      summary="Delete Card by id",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Deleted card successfully",
     *       ),
     *       @OA\Response(
     *          response=403,
     *          description="You are not the owner of this flashcard",
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Card not found",
     *       ),
     *     )
     */
    public function deleteCard($id)
    {
        $card = Card::find($id);
        if (!$card) {
            return response()->json([
                'success' => false,
                'message' => 'Card not found'
            ], 404);
        }
        $flashcard = Flashcard::find($card->flashcard_id);
        if(!$flashcard) {
            return response()->json([
                'success' => false,
                'message' => 'Flashcard not found'
            ], 404);
        }
        
        if (!$this->isOwnerFlashcard($flashcard->id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not the owner of this flashcard'
            ], 403);
        }

        Card::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Delete card successfully'
        ], 200);
    }

    public function isOwnerFlashcard($flashcardId)
    {
        $flashcard = Flashcard::find($flashcardId);
        if (!$flashcard) {
            return false;
        }

        $user = auth()->user();

        if ($flashcard->user_id !== $user->id) {
            return false;
        }

        return true;
    }
}
