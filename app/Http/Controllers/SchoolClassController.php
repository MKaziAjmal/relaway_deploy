<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::latest()->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:100|unique:school_classes,class_name',
            'description' => 'nullable|string',
        ]);

        SchoolClass::create($request->all());

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $class)
    {
        return view('admin.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $class)
    {
        return view('admin.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'class_name' => 'required|string|max:100|unique:school_classes,class_name,' . $class->id,
            'description' => 'nullable|string',
        ]);

        $class->update($request->all());

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with('success', 'Class deleted successfully.');
    }
}