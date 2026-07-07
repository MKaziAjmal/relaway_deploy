<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSubject;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $classSubjects = ClassSubject::with(['schoolClass', 'subject'])
            ->latest()
            ->get();

        return view('admin.class_subjects.index', compact('classSubjects'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        return view('admin.class_subjects.create', compact('classes', 'subjects'));
    }

    /**
     * Store assignment
     */
    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // prevent duplicate assignment
        $exists = ClassSubject::where('school_class_id', $request->school_class_id)
            ->where('subject_id', $request->subject_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This subject already assigned to this class.');
        }

        ClassSubject::create([
            'school_class_id' => $request->school_class_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()
            ->route('class-subjects.index')
            ->with('success', 'Subject assigned to class successfully.');
    }
public function edit(ClassSubject $classSubject)
{
    $classes = SchoolClass::all();
    $subjects = Subject::all();

    return view('admin.class_subjects.edit', compact(
        'classSubject',
        'classes',
        'subjects'
    ));
}
public function update(Request $request, ClassSubject $classSubject)
{
    $request->validate([
        'school_class_id' => 'required|exists:school_classes,id',
        'subject_id' => 'required|exists:subjects,id',
    ]);

    $exists = ClassSubject::where('school_class_id', $request->school_class_id)
        ->where('subject_id', $request->subject_id)
        ->where('id', '!=', $classSubject->id)
        ->exists();

    if ($exists) {
        return back()->with('error', 'Already assigned.');
    }

    $classSubject->update([
        'school_class_id' => $request->school_class_id,
        'subject_id' => $request->subject_id,
    ]);

    return redirect()->route('class-subjects.index')
        ->with('success', 'Updated successfully.');
}
public function show(ClassSubject $classSubject)
{
    $classSubject->load(['schoolClass', 'subject']);

    return view('admin.class_subjects.show', compact('classSubject'));
}
    /**
     * Delete assignment
     */
    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();

        return back()->with('success', 'Assignment removed successfully.');
    }
}