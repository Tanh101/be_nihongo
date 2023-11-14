<?php

namespace App\Repositories\Dictonary;

use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DictionaryRepository extends Dictionary implements DictionaryInterface
{
    public $dictionaryRepository;

    public function __construct(
        DictionaryInterface $dictionaryRepository
    ) {
        $this->dictionaryRepository = $dictionaryRepository;
    }

    public function model()
    {
        return Dictionary::class;
    }

    public function createDictionary($dictionaries)
    {
        $dictionaryArray = [];
        
        foreach ($dictionaries as $dictionary) {
            $word = Word::create([
                'word' => $dictionary['word'],
                'meaning' => $dictionary['meaning'],
                'pronunciation' => $dictionary['pronunciation'],
                'image' => $dictionary['image'] ?? null,
            ]);

            if (!$word) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create word'
                ], 500);
            }

            $newDictionary = Dictionary::create([
                'word_id' => $word->id,
                'example' => $dictionary['example'] ?? null,
                'example_meaning' => $dictionary['example_meaning'] ?? null,
            ]);

            if (!$newDictionary) {
                return response()->json([
                    'status' => '',
                    'message' => 'Failed to create dictionary'
                ], 500);
            }

            array_push($dictionaryArray, $newDictionary);
        }

        return response()->json([
            'status' => 'success',
            'dictionaries' => $dictionaryArray
        ], 200);
    }
}
