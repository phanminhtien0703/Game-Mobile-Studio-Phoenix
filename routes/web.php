<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TouristController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function () {
    // Admin routes
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::resource('admins', AdminController::class)->names('admin.admins');

    // Game routes
    Route::resource('games', GameController::class)->names('admin.games');
    Route::get('/games/show/{game_id}', [GameController::class, 'show'])->name('admin.games.show')->where('game_id', '.*');
    Route::get('/games/create', [GameController::class, 'create'])->name('admin.games.create');
    Route::get('/games/edit', [GameController::class, 'edit'])->name('admin.games.edit');
    Route::delete('/games/destroy', [GameController::class, 'destroy'])->name('admin.games.destroy');

    // Activity routes
    Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities.index');

    // Tourist routes
    Route::get('/tourists', [TouristController::class, 'index'])->name('admin.tourists.index');
});

// Route::get('/users', [UserController::class, 'index']);

// Route::prefix('admin')->group(function () {
//     Route::get('/', function () {
//         return view('admin.admin');
//     });

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     });
// });
