<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TasksController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function() {
    return redirect(route('login'));
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [TasksController::class, 'index'])->name('dashboard');

    Route::get('/tasks', [TasksController::class, 'getTasks'])->name('tasks.index');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TasksController::class, 'show'])->name('tasks.show');
    Route::post('/task/{task}', [TasksController::class, 'update'])->name('task.update');
    Route::delete('/task/{task}', [TasksController::class, 'destroy'])->name('task.destroy');

    Route::post('/task-progress/{task}', [TasksController::class, 'updateProgress'])->name('task.update.progress');

});

require __DIR__.'/auth.php';
