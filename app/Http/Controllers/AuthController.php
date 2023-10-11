<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
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
        $newUser->status = 'active';
        $newUser->save();

        return response()->json([
            'success' => true,
            'message' => 'Register successfully',
            'user' => $newUser,
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email does not exist in the system',
            ], 400);
        }

        if ($user->status == 'inactive') {
            return response()->json([
                'success' => false,
                'message' => 'User is inactive',
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function logout()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 400);
        }

        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 3600,
            'user' => auth()->user()
        ], 200);
    }

    public function user_profile()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'message' => 'User profile',
            'user' => $user
        ], 200);
    }
}
