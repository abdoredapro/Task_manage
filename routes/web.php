<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',

], function () {

    Route::get('/task/trashed', [TaskController::class, 'trash'])->name('task.trash');
    Route::get('/task/{id}/restore', [TaskController::class, 'restore'])->name('task.restore');

    Route::resource('category', CategoryController::class);
    Route::resource('task', TaskController::class);

    // start get task ajax
    Route::post('/task/all', [TaskController::class, 'all'])->name('tasks.all');

    Route::post('/task/filter', [TaskController::class, 'filter'])->name('tasks.filter');

    Route::delete('/task/{id}/delete', [TaskController::class, 'delete'])->name('tasks.delete');
    // Trashed
    

});




Route::get('/dashboard', function () {
    return redirect()->route('dashboard.task.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
