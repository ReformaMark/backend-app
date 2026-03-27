<?php

use Illuminate\Support\Facades\Route;
//PASSPORT IMPORT
use App\Http\Controllers\AuthController;
//Controllers
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CommentController;

//AUTH ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);


Route::get('/fetch-user', [AuthController::class, 'index']);

//Blogs Routes
Route::middleware('auth:api')->group(function () {
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::put('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
    Route::apiResource('blogs.comments', CommentController::class)
        ->scoped();
    Route::post('/upload', [BlogController::class, 'upload']);
    // Route::put('/comments/{comment}', [CommentController::çlass, 'update']);
});

//Branch Routes
Route::middleware('auth:api')->prefix('branches')->group(function () {
    Route::post('/', [BranchController::class, 'store']);
    Route::get('/', [BranchController::class, 'index']);
    Route::get('/summaries', [BranchController::class, 'branchTotals']);
    Route::get('/{branch}', [BranchController::class, 'show']);
    Route::put('/{branch}', [BranchController::class, 'update']);
    Route::delete('/{branch}', [BranchController::class, 'destroy']);
});


Route::middleware('auth:api')->group(function () {
    Route::apiResource('comments', CommentController::class);
});