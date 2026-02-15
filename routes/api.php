<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SavedArticleController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('news', NewsController::class);

  Route::get('saved-articles', [SavedArticleController::class, 'index']);
    Route::post('saved-articles', [SavedArticleController::class, 'store']);
    Route::delete('saved-articles/{id}', [SavedArticleController::class, 'destroy']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
