<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'student_id' => ['required', 'exists:students,id'],
        ]);

        $course = Course::findOrFail($validated['course_id']);
        if ($course->students()->count() >= $course->capacity) {
            return back()->withErrors(['student_id' => 'This course is full.']);
        }
        if ($course->students()->where('students.id', $validated['student_id'])->exists()) {
            return back()->withErrors(['student_id' => 'Student is already enrolled in this course.']);
        }

        $course->students()->attach($validated['student_id']);
        return back()->with('success', 'Student enrolled successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'student_id' => ['required', 'exists:students,id'],
        ]);

        Course::findOrFail($validated['course_id'])
            ->students()
            ->detach($validated['student_id']);

        return back()->with('success', 'Student dropped from course.');
    }
}
