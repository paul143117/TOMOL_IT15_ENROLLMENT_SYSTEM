<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::delete('/enrollments', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

// Login/register as JSON (for SPA/frontend calling backend without /api prefix)
Route::post('/login', function (Request $request) {
    $request->validate(['email' => ['required', 'string', 'email'], 'password' => ['required', 'string']]);
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }
    $token = $user->generateApiToken();
    return response()->json(['user' => $user->only(['id', 'name', 'email']), 'token' => $token, 'token_type' => 'Bearer']);
});
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);
    $token = $user->generateApiToken();
    return response()->json(['user' => $user->only(['id', 'name', 'email']), 'token' => $token, 'token_type' => 'Bearer'], 201);
});
