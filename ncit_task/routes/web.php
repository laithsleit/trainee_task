<?php

use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Models\Subject;

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

Route::middleware(['auth', 'roles:admin'])->group(function () {
    //AdminController
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/students', [AdminController::class, 'storeStd'])->name('students.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'EditStd'])->name('users.edit');
    Route::POST('/students/update', [AdminController::class, 'updateStd'])->name('students.update');
    Route::delete('/students/{student}', [AdminController::class, 'deleteStd'])->name('students.delete');

    //Subjectcontroller
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');

    Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/students', [SubjectController::class, 'viewStudents'])->name('subjects.viewStudents');
    Route::delete('/subjects/{subject}/delete', [SubjectController::class, 'deleteSubject'])->name('subjects.delete');
    Route::post('/subjects/AddStudents', [SubjectController::class, 'addStdToSub'])->name('subjects.addStdToSub');
    Route::post('/update-mark/{studentId}', [SubjectController::class,'updateMark'])->name('update.mark');
    Route::get('/subjects/fetch', [SubjectController::class,'fetchSubjects'])->name('fetch.Subjects');
    Route::get('/students-for-subject/{subjectId}', [SubjectController::class,'fetchStudentsForSubject'])->name('fetch.stdbasedon subject');


});


require __DIR__.'/auth.php';

///////////////////////////////////////////////////////////////////////////////////////////

// user routes
Route::middleware(['auth', 'roles:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});
