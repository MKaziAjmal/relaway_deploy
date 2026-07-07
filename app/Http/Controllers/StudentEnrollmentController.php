<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\ClassSection;
use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Http\Request;

class StudentEnrollmentController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $enrollments = StudentEnrollment::with([
            'student.user',
            'academicYear',
            'classSection.schoolClass',
            'classSection.section'
        ])
        ->latest()
        ->paginate(10);

        return view('admin.student_enrollments.index', compact('enrollments'));
    }

    /**
     * Create form
     */
    public function create()
    {
        $students = Student::with('user')
            ->orderBy('id', 'desc')
            ->get();

        $academicYears = AcademicYear::orderBy('start_date', 'desc')
            ->get();

        $classSections = ClassSection::with([
            'schoolClass',
            'section'
        ])->get();

        return view('admin.student_enrollments.create', compact(
            'students',
            'academicYears',
            'classSections'
        ));
    }

    /**
     * Store enrollment
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'roll_no' => 'required|string|max:20',
            'status' => 'required|string'
        ]);

        // Prevent duplicate enrollment
        $exists = StudentEnrollment::where('student_id', $request->student_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Student already enrolled in this academic year.');
        }

        StudentEnrollment::create([
            'student_id' => $request->student_id,
            'academic_year_id' => $request->academic_year_id,
            'class_section_id' => $request->class_section_id,
            'roll_no' => $request->roll_no,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('student-enrollments.index')
            ->with('success', 'Student enrolled successfully.');
    }

    /**
     * Show details
     */
    public function show(StudentEnrollment $studentEnrollment)
    {
        $studentEnrollment->load([
            'student.user',
            'academicYear',
            'classSection.schoolClass',
            'classSection.section'
        ]);

        return view('admin.student_enrollments.show', compact('studentEnrollment'));
    }

    /**
     * Edit form
     */
    public function edit(StudentEnrollment $studentEnrollment)
    {
        $students = Student::with('user')
            ->orderBy('id', 'desc')
            ->get();

        $academicYears = AcademicYear::orderBy('start_date', 'desc')
            ->get();

        $classSections = ClassSection::with([
            'schoolClass',
            'section'
        ])->get();

        return view('admin.student_enrollments.edit', compact(
            'studentEnrollment',
            'students',
            'academicYears',
            'classSections'
        ));
    }

    /**
     * Update enrollment
     */
    public function update(Request $request, StudentEnrollment $studentEnrollment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'class_section_id' => 'required|exists:class_sections,id',
            'roll_no' => 'required|string|max:20',
            'status' => 'required|string'
        ]);

        // Prevent duplicate (excluding current record)
        $exists = StudentEnrollment::where('student_id', $request->student_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('id', '!=', $studentEnrollment->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Enrollment already exists for this student.');
        }

        $studentEnrollment->update([
            'student_id' => $request->student_id,
            'academic_year_id' => $request->academic_year_id,
            'class_section_id' => $request->class_section_id,
            'roll_no' => $request->roll_no,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('student-enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Delete enrollment
     */
    public function destroy(StudentEnrollment $studentEnrollment)
    {
        $studentEnrollment->delete();

        return redirect()
            ->route('student-enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}