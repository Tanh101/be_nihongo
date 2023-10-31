<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard/users",
     *     summary="Get all users by status",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"active", "inactive", "banned"},
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             enum={10, 20, 15},
     *         )
     *     ),
     *     @OA\Response(response="200", description="Get users successfully"),
     *     @OA\Response(response="404", description="Users not found"),
     * )
     */
    public function get_all_users(Request $request)
    {
        $status = $request->status;
        $perPage = $request->input('per_page', 10);
        if($status == null) {
            $users = User::paginate($perPage);
        } else {
            $users = User::where('status', $status)->paginate($perPage);
        }
        if ($users->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Users not found'
            ], 404);
        }

        $totalPages = ceil($users->total() / $perPage);
        $pagination = [
            'per_page' => $users->perPage(),
            'current_page' => $users->currentPage(),
            'total_pages' => $totalPages,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Get users successfully',
            'total_result' => $users->total(),
            'pagination' => $pagination,
            'users' => $users->items()
        ], 200);
    }

    /**
     * @OA\Patch(
     *     path="/api/dashboard/users/{id}",
     *     summary="Update a user's status by ID",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"active", "inactive", "banned"},
     *         )
     *     ),
     *     @OA\Response(response="200", description="Update user's status successfully"),
     *     @OA\Response(response="404", description="User not found"),
     *     @OA\Response(response="400", description="Validation error"),
     * )
     */
    public function update_status(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toJson()
            ], 400);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Update user status successfully',
            'user' => $user
        ], 200);
    }

}
