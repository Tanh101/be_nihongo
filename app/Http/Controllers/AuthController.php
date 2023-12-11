<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register a new user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *           @OA\Property(
     *               property="name",
     *               type="string",
     *               description="Name",
     *               example="lyvantanh"
     *           ),
     *           @OA\Property(
     *              property="email",
     *              type="string",
     *              description="Email",
     *              example="lyvantanh1@gmail.com"
     *          ),
     *          @OA\Property(
     *              property="password",
     *              type="string",
     *              description="Password",
     *              example="12345678"
     *          ),
     *          @OA\Property(
     *              property="password_confirmation",
     *              type="string",
     *              description="Password confirmation",
     *              example="12345678"
     *          )
     *       )
     *   ),
     *   @OA\Response(response="200", description="User registered successfully"),
     *   @OA\Response(response="400", description="Validation errors")
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login User",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *           @OA\Property(
     *              property="email",
     *              type="string",
     *              description="Email",
     *              example="admin@gmail.com"
     *          ),
     *          @OA\Property(
     *              property="password",
     *              type="string",
     *              description="Password",
     *              example="12345678"
     *          )
     *       )
     *   ),
     *     @OA\Response(response="200", description="Logged in successfully"),
     *     @OA\Response(response="400", description="Validation errors"),
     *     @OA\Response(response="401", description="Password incorrect"),
     * )
     */
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
            return response()->json(['error' => 'Password incorrect'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Logout User",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Logged out successfully"),
     *     @OA\Response(response="400", description="User is not logged in"),
     *     @OA\Response(response="401", description="Password incorrect"),
     * )
     */
    public function logout()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not logged in',
            ], 400);
        }

        Auth::logout();

        return response()->json([
            'message' => 'Logged out successfully',
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/refresh",
     *     summary="Refresh Token",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Refresh token successfully"),
     * )
     */
    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'user' => auth()->user()
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/profile",
     *     summary="Refresh Token",
     *     tags={"Auth"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Get user profile successfully"),
     * )
     */
    public function user_profile()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'message' => 'Get user profile successfully',
            'user' => $user
        ], 200);
    }
}
