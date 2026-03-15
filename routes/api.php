<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\AuthenticateApi;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'message' => 'API is running']);
});

// ----- Auth (login/register) - multiple paths so frontend never gets 404 -----
$loginHandler = function (Request $request) {
    $request->validate([
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages(['email' => ['The provided credentials are incorrect.']]);
    }
    $token = $user->generateApiToken();
    return response()->json([
        'user' => $user->only(['id', 'name', 'email']),
        'token' => $token,
        'token_type' => 'Bearer',
    ]);
};
$registerHandler = function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);
    $token = $user->generateApiToken();
    return response()->json([
        'user' => $user->only(['id', 'name', 'email']),
        'token' => $token,
        'token_type' => 'Bearer',
    ], 201);
};

Route::post('/login', $loginHandler);
Route::post('/auth/login', $loginHandler);
Route::post('/register', $registerHandler);
Route::post('/auth/register', $registerHandler);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(AuthenticateApi::class);

Route::get('/students', function () {
    return Student::withCount('courses')->orderBy('full_name')->get();
});
Route::get('/students/{student}', function (Student $student) {
    $student->load('courses');
    return $student;
});

Route::get('/courses', function () {
    return Course::withCount('students')->orderBy('course_code')->get();
});
Route::get('/courses/{course}', function (Course $course) {
    $course->load('students');
    $course->setRelation('available_students', Student::whereDoesntHave('courses', fn ($q) => $q->where('courses.id', $course->id))->orderBy('full_name')->get());
    return $course;
});

Route::post('/enrollments', function (Request $request) {
    $validated = $request->validate([
        'course_id' => ['required', 'exists:courses,id'],
        'student_id' => ['required', 'exists:students,id'],
    ]);
    $course = Course::findOrFail($validated['course_id']);
    if ($course->students()->count() >= $course->capacity) {
        return response()->json(['message' => 'Course is full.'], 422);
    }
    if ($course->students()->where('students.id', $validated['student_id'])->exists()) {
        return response()->json(['message' => 'Student already enrolled.'], 422);
    }
    $course->students()->attach($validated['student_id']);
    return response()->json(['message' => 'Enrolled successfully.'], 201);
});
Route::delete('/enrollments', function (Request $request) {
    $validated = $request->validate([
        'course_id' => ['required', 'exists:courses,id'],
        'student_id' => ['required', 'exists:students,id'],
    ]);
    Course::findOrFail($validated['course_id'])->students()->detach($validated['student_id']);
    return response()->json(['message' => 'Dropped successfully.']);
});
