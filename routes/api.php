<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;

Route::post('/register' , [AuthController::class, 'register']);
Route::post('/login' , [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Exemples de routes pour les différents rôles
    Route::middleware('role:admin')->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
    });

    Route::middleware('role:responsable')->group(function () {
        Route::post('/posts/{id}/update', [PostController::class, 'update']);
    });

    Route::middleware('role:client')->group(function () {
        Route::delete('/posts/{id}/delete', [PostController::class, 'destroy']);
    });
});