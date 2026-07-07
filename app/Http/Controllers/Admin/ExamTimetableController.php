<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamTimetable;
use App\Models\ExamType;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ClassSection;

class ExamTimetableController extends Controller
{
    /**
     * LIST
     */
   public function index(Request $request)
{
    $examTypes = ExamType::orderBy('name')->get();

    $query = ExamTimetable::with([
        'examType',
        'academicYear',
        'schoolClass',
        'section',
        'subject'
    ]);

    if ($request->filled('exam_id')) {
        $query->where('exam_id', $request->exam_id);
    }

    $examTimetables = $query
        ->orderBy('exam_date')
        ->paginate(20)
        ->withQueryString();

    return view('admin.exam-timetables.index', compact(
        'examTimetables',
        'examTypes'
    ));
}public function print($exam = null)
{
    $query = ExamTimetable::with([
        'examType',
        'academicYear',
        'schoolClass',
        'section',
        'subject'
    ]);

    if ($exam) {
        $query->where('exam_id', $exam);
    }

    $examTimetables = $query
        ->orderBy('exam_date')
        ->get();

    return view('admin.exam-timetables.print', compact('examTimetables'));
}
    /**
     * CREATE FORM (NO AJAX VERSION)
     */
    public function create(Request $request)
    {
        $classId = $request->school_class_id;

        $selectedClass = $classId;

        // default empty collections
        $sections = collect();
        $subjects = Subject::all(); // GLOBAL FIX

        // load sections only if class selected
        if ($classId) {

            $sections = ClassSection::with('section')
                ->where('school_class_id', $classId)
                ->get()
                ->map(function ($item) {
                    return $item->section;
                });
        }

        return view('admin.exam-timetables.create', [
            'examTypes' => ExamType::all(),
            'academicYears' => AcademicYear::all(),
            'classes' => SchoolClass::all(),
            'sections' => $sections,
            'subjects' => $subjects,
            'selectedClass' => $selectedClass,
        ]);
    }

    /**
     * STORE
     */
    public function store(Request $request)
{
    $request->validate([
        'exam_id' => 'required|exists:exam_types,id',
        'academic_year_id' => 'required|exists:academic_years,id',
        'school_class_id' => 'required|exists:school_classes,id',
        'section_id' => 'required|exists:sections,id',
        'subject_id' => 'required|exists:subjects,id',
        'exam_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'room' => 'nullable|string|max:255',
        'remarks' => 'nullable|string',
    ]);

    ExamTimetable::create([
        'exam_id'          => $request->exam_id,
        'academic_year_id' => $request->academic_year_id,
        'school_class_id'  => $request->school_class_id,
        'section_id'       => $request->section_id,
        'subject_id'       => $request->subject_id,
        'exam_date'        => $request->exam_date,
        'start_time'       => $request->start_time,
        'end_time'         => $request->end_time,
        'room'             => $request->room,
        'remarks'          => $request->remarks,
    ]);

    return redirect()
        ->route('exam-timetables.index')
        ->with('success', 'Exam timetable created successfully.');
}

    /**
     * OPTIONAL: AJAX endpoints (if you ever need later)
     */
    public function getSections($class_id)
    {
        return ClassSection::with('section')
            ->where('school_class_id', $class_id)
            ->get()
            ->map(fn($item) => [
                'id' => $item->section->id,
                'name' => $item->section->section_name
            ]);
    }

    public function edit(ExamTimetable $examTimetable)
{
    return view('admin.exam-timetables.edit', [
        'examTimetable' => $examTimetable,
        'examTypes' => ExamType::all(),
        'academicYears' => AcademicYear::all(),
        'classes' => SchoolClass::all(),
        'sections' => Section::all(),
        'subjects' => Subject::all(),
    ]);
}public function update(Request $request, ExamTimetable $examTimetable)
{
    $request->validate([
        'exam_id' => 'required|exists:exam_types,id',
        'academic_year_id' => 'required|exists:academic_years,id',
        'school_class_id' => 'required|exists:school_classes,id',
        'section_id' => 'required|exists:sections,id',
        'subject_id' => 'required|exists:subjects,id',
        'exam_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'room' => 'nullable|string|max:255',
        'remarks' => 'nullable|string',
    ]);

    $examTimetable->update($request->all());

    return redirect()
        ->route('exam-timetables.index')
        ->with('success', 'Exam timetable updated successfully.');
}
public function destroy(ExamTimetable $examTimetable)
{
    $examTimetable->delete();

    return redirect()
        ->route('exam-timetables.index')
        ->with('success', 'Exam timetable deleted successfully.');
}
    public function getSubjects()
    {
        return Subject::select('id', 'name')->get();
    }
}