<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:8|confirmed',

            'admission_no'      => 'required|string|max:50|unique:students,admission_no',
            'gender'            => 'required|in:Male,Female',
            'date_of_birth'     => 'required|date',
            'phone'             => 'required|string|max:20',
            'address'           => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => 'student',
            ]);

            Student::create([
                'user_id'           => $user->id,
                'admission_no'      => $request->admission_no,
                'gender'            => $request->gender,
                'date_of_birth'     => $request->date_of_birth,
                'phone'             => $request->phone,
                'address'           => $request->address,
            ]);
        });

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('user');

        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load('user');

        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $student->user_id,
            'admission_no'      => 'required|string|max:50|unique:students,admission_no,' . $student->id,
            'gender'            => 'required|in:Male,Female',
            'date_of_birth'     => 'required|date',
            'phone'             => 'required|string|max:20',
            'address'           => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $student) {

            $student->user->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $student->update([
                'admission_no'      => $request->admission_no,
                'gender'            => $request->gender,
                'date_of_birth'     => $request->date_of_birth,
                'phone'             => $request->phone,
                'address'           => $request->address,
            ]);
        });

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {

            $user = $student->user;

            $student->delete();

            $user->delete();
        });

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}