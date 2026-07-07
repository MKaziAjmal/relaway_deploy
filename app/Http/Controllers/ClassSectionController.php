<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classSections = ClassSection::with(['schoolClass', 'section'])
            ->latest()
            ->paginate(10);

        return view('admin.class_sections.index', compact('classSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::orderBy('class_name')->get();
        $sections = Section::orderBy('section_name')->get();

        return view('admin.class_sections.create', compact('classes', 'sections'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'section_id'      => 'required|exists:sections,id',
        ]);

        $exists = ClassSection::where('school_class_id', $request->school_class_id)
            ->where('section_id', $request->section_id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'This section is already assigned to the selected class.');
        }

        ClassSection::create($request->only([
            'school_class_id',
            'section_id'
        ]));

        return redirect()
            ->route('class-sections.index')
            ->with('success', 'Class Section assigned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSection $classSection)
    {
        $classSection->load(['schoolClass', 'section']);

        return view('admin.class_sections.show', compact('classSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSection $classSection)
    {
        $classes = SchoolClass::orderBy('class_name')->get();
        $sections = Section::orderBy('section_name')->get();

        return view('admin.class_sections.edit', compact(
            'classSection',
            'classes',
            'sections'
        ));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, ClassSection $classSection)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'section_id'      => 'required|exists:sections,id',
        ]);

        $exists = ClassSection::where('school_class_id', $request->school_class_id)
            ->where('section_id', $request->section_id)
            ->where('id', '!=', $classSection->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'This assignment already exists.');
        }

        $classSection->update($request->only([
            'school_class_id',
            'section_id'
        ]));

        return redirect()
            ->route('class-sections.index')
            ->with('success', 'Class Section updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(ClassSection $classSection)
    {
        $classSection->delete();

        return redirect()
            ->route('class-sections.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}