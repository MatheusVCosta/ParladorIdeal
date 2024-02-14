<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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


Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function ($api) {
    $api->post('/logout', [AuthController::class, 'logout']);

    $api->put('/users/{userId}', [UserController::class, 'update']);
    $api->delete('/users/{userId}', [UserController::class, 'destroy']);

    $api->get('/posts', [PostController::class, 'showPosts']);
    $api->post('/posts', [PostController::class, 'store']);

    //My posts
    $api->get('/posts/myPost/{postId}', [PostController::class, 'show']);
    $api->put('/posts/myPosts/{postId}', [PostController::class, 'update']);
    $api->delete('/posts/myPosts/{postId}', [PostController::class, 'destroy']);
});
