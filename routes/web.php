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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//  Define the projects routes
Route::resource('projects', ProjectController::class)->only(['index', 'show', 'store', 'update', 'create']);

// Define tasks routes
Route::name('tasks.')->prefix('tasks')->group(function(){
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::get('/{project}/create', [TaskController::class, 'create'])->name('create');
    Route::put('/priority', [TaskController::class, 'updatePriority'])->name('priority');
});
Route::resource('tasks', TaskController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

require __DIR__.'/auth.php';
