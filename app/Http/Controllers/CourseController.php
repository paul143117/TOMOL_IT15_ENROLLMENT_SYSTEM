<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::withCount('students')->orderBy('course_code')->get();
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course): View
    {
        $course->load('students');
        $availableStudents = Student::whereDoesntHave('courses', function ($q) use ($course) {
            $q->where('courses.id', $course->id);
        })->orderBy('full_name')->get();
        return view('courses.show', compact('course', 'availableStudents'));
    }
}
