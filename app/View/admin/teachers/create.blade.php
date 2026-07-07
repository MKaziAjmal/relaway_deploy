<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')
                        ->latest()
                        ->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'teacher',
        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher added successfully.');
    }

    public function show(User $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(User $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(User $teacher)
    {
        $teacher->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}