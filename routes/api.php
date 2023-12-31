<?php

use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//users index + show routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{slug}', [UserController::class, 'show']);
// store messages from vue input
Route::post('/messages', [MessageController::class, 'store']);
// store reviews from vue input
Route::post('/reviews', [ReviewController::class, 'store']);
// store votes from vue input
Route::post('/votes', [VoteController::class, 'store']);
