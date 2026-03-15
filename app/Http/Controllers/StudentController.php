<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::withCount('courses')->orderBy('full_name')->get();
        return view('students.index', compact('students'));
    }

    public function show(Student $student): View
    {
        $student->load('courses');
        return view('students.show', compact('student'));
    }
}
