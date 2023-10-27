<?php

use App\Http\Controllers\API\Admin\GroupController as AdminGroupController;
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Support\Facades\Route;

Route::fallback(function(){
    return response()->json([
        'message' => 'Page not found. If error persists, contact https://t.me/nourizzW'], 404);
});

require __DIR__ . '/guest.php';

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::prefix('admin')
        ->middleware('role:admin')
        ->name('admin.')
        ->group(function () {
            Route::apiResource('groups', AdminGroupController::class);
    });

    Route::apiResource('groups', GroupController::class)
        ->shallow()
        ->only(['index', 'show']);
    Route::apiResource('groups.tasks', TaskController::class)->shallow();
    Route::apiResource('tasks.answers', AnswerController::class)->shallow();

    require __DIR__ . '/auth.php';
});


