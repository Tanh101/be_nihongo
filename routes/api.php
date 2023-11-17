<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\WordController;
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

//Admin API
Route::group([
    'prefix' => 'dashboard',
    'middleware' => [
        'checkLogin',
        'checkAdmin',
        'verifyToken'
    ],
], function () {
    //users
    Route::get('users', [UserController::class, "get_all_users"])->name('users');
    Route::patch('users/{id}', [UserController::class, "update_status"])->name('ban_unban');

    //lessons
    Route::get("lessons/", [LessonController::class, "get_all_lessons_admin"]);
    Route::post("lessons/", [LessonController::class, "create_lesson"]);
    Route::put("lessons/{id}", [LessonController::class, "update_lesson"]);
    Route::patch("lessons/{id}", [LessonController::class, "restore_lesson"]);
    Route::delete("lessons/{id}", [LessonController::class, "delete_lesson"]);

    //topics
    Route::post("topics/", [TopicController::class, "create_topic"]);
    Route::put("topics/{id}", [TopicController::class, "update_topic"]);
    Route::delete("topics/{id}", [TopicController::class, "delete_topic"]);
    Route::get('topics', [TopicController::class, "get_all_topics_by_admin"]);
    Route::patch('topics/{id}', [TopicController::class, "restore_topic"]);
    Route::get("topics/{id}", [TopicController::class, "get_topic"]);

    //vocabulary
    Route::post("vocabularies/{id}", [VocabularyController::class, "create_vocabularies_questions"]);

    //dictonaries
    Route::post("dictionaries", [DictionaryController::class, "createDictionary"]);
    Route::put("dictionaries/{id}", [DictionaryController::class, "updateDictionary"]);
    Route::delete("dictionaries/{id}", [DictionaryController::class, "deleteDictionary"]);
});

//Topics API
Route::group([
    'prefix' => 'topics',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::get("/", [TopicController::class, "get_all_topics_by_user"]);
});

//Lessons API
Route::group([
    'prefix' => 'lessons',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::get("{id}", [LessonController::class, "getVocabulariesByLessonId"]);
});


//Learning API
Route::group([
    'prefix' => 'learn',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::post("{id}", [LearningController::class, "learnBylessonId"]);
});

//check answer API
Route::group([
    'prefix' => 'check',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::patch("{id}", [LearningController::class, "checkAnswer"]);
});

//Dictionary API
Route::group([
    'prefix' => 'dictionaries',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::get("", [DictionaryController::class, "searchDictionaryByWord"]);
});

//word API
Route::group([
    'prefix' => 'words',
    'middleware' => [
        'checkLogin',
        'verifyToken'
    ],
], function () {
    Route::get("{word}", [WordController::class, "wordDetail"]);
});
