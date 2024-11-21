<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\OjtRecordsController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\DerogatoryRecordController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root URL to /login
Route::get('/', function () {
    return redirect('/login');
});

// Login routes
Route::get('/login', function () {
    // Redirect to dashboard if already logged in
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalStudents' => \App\Models\Student::count(),
        'totalDerogatory' => \App\Models\DerogatoryRecord::count(),
        'totalInterns' => \App\Models\Intern::count(),
        'totalOJT' => \App\Models\OJTRecord::count(),
    ]);
})->middleware(['auth'])->name('dashboard');

// Student routes
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
});

// Intern routes
Route::middleware('auth')->group(function () {
    Route::get('/intern-profile', [InternController::class, 'index'])->name('intern.profile');
    Route::get('/intern-profile/{intern}/edit', [InternController::class, 'edit'])->name('intern.edit');
    Route::put('/intern-profile/{intern}', [InternController::class, 'update'])->name('intern.update');
    Route::delete('/intern-profile/{intern}', [InternController::class, 'destroy'])->name('intern.destroy');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //OJT Records and coordinator routes
    Route::get('/ojt-records', [OjtRecordsController::class, 'index'])->name('ojt.records');
    Route::resource('ojt_records', OjtRecordsController::class);
    Route::post('/coordinator/store', [CoordinatorController::class, 'store'])->name('coordinator.store');
    Route::resource('coordinators', CoordinatorController::class);

// Route to display the list of derogatory records
Route::get('/derogatory_records', [DerogatoryRecordController::class, 'index'])->name('derogatory_records.index');
Route::resource('derogatory_records', DerogatoryRecordController::class);

// Route to display the form for creating a new derogatory record
Route::get('/derogatory_records/create', [DerogatoryRecordController::class, 'create'])->name('derogatory_records.create');

// Route to handle storing the new derogatory record
Route::post('/derogatory_records', [DerogatoryRecordController::class, 'store'])->name('derogatory_records.store');

// Route to show a specific derogatory record's details
Route::get('/derogatory_records/{id}', [DerogatoryRecordController::class, 'show'])->name('derogatory_records.show');

// Route to display the form for editing an existing derogatory record
Route::get('/derogatory_records/{id}/edit', [DerogatoryRecordController::class, 'edit'])->name('derogatory_records.edit');

// Route to handle updating the derogatory record
Route::put('/derogatory_records/{id}', [DerogatoryRecordController::class, 'update'])->name('derogatory_records.update');

// Route to handle deleting a derogatory record
Route::delete('/derogatory_records/{id}', [DerogatoryRecordController::class, 'destroy'])->name('derogatory_records.destroy');

// Add this new route for status updates
Route::patch('/intern-profile/{intern}/status', [InternController::class, 'updateStatus'])
    ->name('intern.update.status');

Route::post('/interns/{intern}/upload-document', [InternController::class, 'uploadDocument'])
    ->name('interns.upload-document');

// Add this route if it doesn't exist
Route::get('/interns', [InternController::class, 'index'])->name('intern.index');
Route::get('/interns/{student_number}/edit', [InternController::class, 'edit'])->name('intern.edit');
Route::put('/interns/{student_number}', [InternController::class, 'update'])->name('intern.update');
Route::delete('/interns/{student_number}', [InternController::class, 'destroy'])->name('intern.destroy');

});

require __DIR__.'/auth.php';