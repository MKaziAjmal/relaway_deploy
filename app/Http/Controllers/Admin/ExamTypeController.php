<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $examTypes = ExamType::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.exam-types.index', compact('examTypes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exam-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:exam_types,code',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        ExamType::create($validated);

        return redirect()
            ->route('exam-types.index')
            ->with('success', 'Exam Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamType $examType)
    {
        return view('admin.exam-types.show', compact('examType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamType $examType)
    {
        return view('admin.exam-types.edit', compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExamType $examType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:exam_types,code,' . $examType->id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $examType->update($validated);

        return redirect()
            ->route('exam-types.index')
            ->with('success', 'Exam Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamType $examType)
    {
        $examType->delete();

        return redirect()
            ->route('exam-types.index')
            ->with('success', 'Exam Type deleted successfully.');
    }
}