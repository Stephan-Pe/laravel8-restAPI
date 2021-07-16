<?php

use App\Models\Posts;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;
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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
Route::get('/posts/search/{title}', [PostsController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/posts', [PostsController::class, 'store']);
    Route::put('/posts/{id}', [PostsController::class, 'update']);
    Route::delete('/posts/{id}', [PostsController::class, 'destroy']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
