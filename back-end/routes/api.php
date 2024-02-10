<?php

use App\Http\Controllers\Api\Auth\AuthController;
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


Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function ($api) {
    $api->get('/users', [UserController::class, 'index']);
    $api->post('/users', [UserController::class, 'store']);
});