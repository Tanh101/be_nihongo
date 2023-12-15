<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlashcardController extends Controller
{
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
            ]);
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
            ]);
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
                ]);
            }
        }

        return response()->json([
            'succes' => true,
            'message' => 'Flashcard created successfully',
            'flashcard' => $flashcard->load('cards')
        ]);
    }
}
