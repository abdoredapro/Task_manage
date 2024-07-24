<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('task/all', [TaskController::class, 'index']);

Route::post('task/create', [TaskController::class, 'store']);

Route::put('task/{task_id}/update', [TaskController::class, 'update']);

Route::delete('task/{task_id}/delete', [TaskController::class, 'destroy']);

Route::get('task/{task_id}/restore', [TaskController::class, 'restore']);





