<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth API
Route::group(['prefix' => 'auth'], function () {
    Route::post("register", [AuthController::class, "register"])->name('register');
    Route::post("login", [AuthController::class, "login"])->name('login');
});

Route::group([
    'prefix' => 'auth',
    'middleware' => [
        'checkLogin',
    ],
], function () {
    Route::get("profile", [AuthController::class, "user_profile"])->name('profile');
    Route::post("logout", [AuthController::class, "logout"])->name('logout');
    Route::post("refresh", [AuthController::class, "refresh"])->name('refresh');
});
