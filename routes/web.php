<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('projects', ProjectController::class);
Route::prefix('projects')->as('projects.')->group(function () {
    Route::prefix('{project}')->group(function () {
        Route::post('reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
        Route::resource('tasks', TaskController::class);
    });
});
