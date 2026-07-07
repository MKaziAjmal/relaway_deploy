<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = AcademicYear::latest()->paginate(10);

        return view('admin.academic-years.index', compact('academicYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:academic_years,name',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'nullable|boolean',
        ]);

        if ($request->is_current) {
            AcademicYear::query()->update([
                'is_current' => false,
            ]);
        }

        AcademicYear::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_current' => $request->boolean('is_current'),
        ]);

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Academic year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        return view('admin.academic-years.show', compact('academicYear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('admin.academic-years.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:academic_years,name,' . $academicYear->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_current' => 'nullable|boolean',
        ]);

        if ($request->is_current) {
            AcademicYear::query()->update([
                'is_current' => false,
            ]);
        }

        $academicYear->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_current' => $request->boolean('is_current'),
        ]);

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Academic year updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()
            ->route('academic-years.index')
            ->with('success', 'Academic year deleted successfully.');
    }
}