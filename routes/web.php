<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\OjtRecordsController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\DerogatoryRecordController;
use App\Http\Controllers\DerogatoryRecordHistoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Redirect root URL to /login
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/protected-route', [SomeController::class, 'someMethod'])->name('protected.route');
});

// Student routes
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::post('/register', [StudentController::class, 'store'])->name('students.store');
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
Route::resource('derogatory_records', DerogatoryRecordController::class);

// Route to display the form for creating a new derogatory record
Route::get('/derogatory_records/create', [DerogatoryRecordController::class, 'create'])->name('derogatory_records.create');

// Route to handle storing the new derogatory record
Route::post('derogatory_records/{student_id}', [DerogatoryRecordController::class, 'store'])->name('derogatory_records.store');
// In your routes file
Route::get('derogatory_records/{student_id}', [DerogatoryRecordController::class, 'show'])->name('derogatory_records.show');
Route::get('/students/{studentId}/history', [DerogatoryRecordController::class, 'showHistory'])->name('students.history');
// Route to display the form for editing an existing derogatory record
Route::get('derogatory_records/{id}/edit', [DerogatoryRecordController::class, 'edit'])->name('derogatory_records.edit');
Route::get('/api/penalty', [DerogatoryRecordController::class, 'getPenalty'])->name('penalty.fetch');
Route::get('derogatory-record-histories/{id}/edit', [DerogatoryRecordHistoryController::class, 'edit'])->name('derogatory_record_histories.edit');
Route::put('derogatory-record-histories/{id}', [DerogatoryRecordHistoryController::class, 'update'])->name('derogatory_record_histories.update');

// Route to handle updating the derogatory record
// In routes/web.php
Route::put('/updateRecord/{id}', [DerogatoryRecordController::class, 'update']);

Route::post('/derogatory-records/{student}/add', [DerogatoryRecordController::class, 'store'])->name('derogatory_records.add');

// Route to handle deleting a derogatory record
Route::delete('/derogatory_records/{id}', [DerogatoryRecordController::class, 'destroy'])->name('derogatory_records.destroy');

Route::get('/complaints/create/{student_id_number}', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('complaints', [ComplaintController::class, 'store'])->name('complaints.store');


Route::get('/evidence-files/{filename}', [FileController::class, 'showEvidenceFile'])->name('evidence.file');

Route::get('/complaints/{id}/{mode?}', [ComplaintController::class, 'showOrEdit'])->name('complaints.showOrEdit');
Route::put('/complaints/{id}', [ComplaintController::class, 'update'])->name('complaints.update');

Route::delete('/complaints/{id}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');



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