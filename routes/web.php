<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InternController;
use Illuminate\Support\Facades\Route;

// Redirect root URL to /login
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard route
Route::get('/dashboard', [StudentController::class, 'index'])->name('student.profile');

// Student routes
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

// Import students info using excel
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');

// Intern routes
Route::middleware(['auth'])->group(function () {
    Route::get('/intern-profile', [InternController::class, 'index'])->name('intern.profile');
    Route::get('/intern-profile/create', [InternController::class, 'create'])->name('intern.create');
    Route::post('/intern-profile', [InternController::class, 'store'])->name('intern.store');
    Route::get('/intern-profile/{id}/edit', [InternController::class, 'edit'])->name('intern.edit');
    Route::put('/intern-profile/{id}', [InternController::class, 'update'])->name('intern.update');
    Route::delete('/intern-profile/{id}', [InternController::class, 'destroy'])->name('intern.destroy');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';