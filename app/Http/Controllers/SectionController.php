<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::latest()->paginate(10);

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|string|max:10|unique:sections,section_name',
            'description' => 'nullable|string',
        ]);

        Section::create($request->all());

        return redirect()
            ->route('sections.index')
            ->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'section_name' => 'required|string|max:10|unique:sections,section_name,' . $section->id,
            'description' => 'nullable|string',
        ]);

        $section->update($request->all());

        return redirect()
            ->route('sections.index')
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()
            ->route('sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}