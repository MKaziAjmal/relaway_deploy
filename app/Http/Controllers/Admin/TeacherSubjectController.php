<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        $assignments = TeacherSubject::with([
            'teacher',
            'schoolClass',
            'section',
            'subject',
            'academicYear'
        ])->latest()->get();

        return view('admin.teacher_subjects.index', compact('assignments'));
    }

    public function create()
    {
        return view('admin.teacher_subjects.create', [
            'teachers' => Teacher::with('user')->get(),
            'classes' => SchoolClass::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'academicYears' => AcademicYear::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'school_class_id' => 'required|exists:school_classes,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $exists = TeacherSubject::where($request->only([
            'teacher_id',
            'school_class_id',
            'section_id',
            'subject_id',
            'academic_year_id'
        ]))->exists();

        if ($exists) {
            return back()->with('error', 'This assignment already exists.');
        }

        TeacherSubject::create($request->all());

        return redirect()->route('teacher-subjects.index')
            ->with('success', 'Assignment created successfully.');
    }
    public function show(TeacherSubject $teacherSubject)
{
    $teacherSubject->load([
        'teacher.user',
        'schoolClass',
        'section',
        'subject',
        'academicYear'
    ]);

    return view('admin.teacher_subjects.show', compact('teacherSubject'));
}
public function edit(TeacherSubject $teacherSubject)
{
    $teachers = Teacher::with('user')->get();
    $classes = SchoolClass::all();
    $sections = Section::all();
    $subjects = Subject::all();
    $academicYears = AcademicYear::all();

    return view('admin.teacher_subjects.edit', compact(
        'teacherSubject',
        'teachers',
        'classes',
        'sections',
        'subjects',
        'academicYears'
    ));
}
public function update(Request $request, TeacherSubject $teacherSubject)
{
    $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'school_class_id' => 'required|exists:school_classes,id',
        'section_id' => 'required|exists:sections,id',
        'subject_id' => 'required|exists:subjects,id',
        'academic_year_id' => 'required|exists:academic_years,id',
    ]);

    $teacherSubject->update($request->all());

    return redirect()
        ->route('teacher-subjects.index')
        ->with('success', 'Assignment updated successfully.');
}

    public function destroy(TeacherSubject $teacherSubject)
    {
        $teacherSubject->delete();

        return back()->with('success', 'Deleted successfully.');
    }
}