<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function create()
    {
        return view('admin.class-subjects.create', [
            'classes' => SchoolClass::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Your logic to assign subject to class
        // This depends on your database structure
        
        return redirect()
            ->route('class-subjects.index')
            ->with('success', 'Subject assigned to class successfully.');
    }
}