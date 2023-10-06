<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'validation error',
                'errors' => $validator->errors(),
            ], 400);
        }
        $newUser = new User();
        $newUser->fill([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $newUser->status = 'ative';
        $newUser->save();

        return response()->json([
            'success' => true,
            'message' => 'Register successfully',
            'user' => $newUser,
        ], 200);
    }
}
