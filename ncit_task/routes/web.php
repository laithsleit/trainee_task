<?php

use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;


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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});



//admin routes

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/students', [AdminController::class, 'storeStd'])->name('students.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'EditStd'])->name('users.edit');
    Route::POST('/students/update', [AdminController::class, 'updateStd'])->name('students.update');
    Route::delete('/students/{student}', [AdminController::class, 'deleteStd'])->name('students.delete');

});


require __DIR__.'/auth.php';

///////////////////////////////////////////////////////////////////////////////////////////

// user routes
Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});
