@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h3>Assign Teacher to Subject</h3>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teacher-subjects.store') }}" method="POST">
                @csrf

                {{-- Teacher --}}
                <div class="mb-3">
                    <label class="form-label">Teacher</label>

                    <select name="teacher_id" class="form-select" required>
                        <option value="">Select Teacher</option>

                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">
                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Class --}}
                <div class="mb-3">
                    <label class="form-label">Class</label>

                    <select name="school_class_id" class="form-select" required>
                        <option value="">Select Class</option>

                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Section --}}
                <div class="mb-3">
                    <label class="form-label">Section</label>

                    <select name="section_id" class="form-select" required>
                        <option value="">Select Section</option>

                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">
                                {{ $section->section_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Subject --}}
                <div class="mb-3">
                    <label class="form-label">Subject</label>

                    <select name="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>

                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Academic Year --}}
                <div class="mb-3">
                    <label class="form-label">Academic Year</label>

                    <select name="academic_year_id" class="form-select" required>
                        <option value="">Select Year</option>

                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}">
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success">
                    Save Assignment
                </button>

                <a href="{{ route('teacher-subjects.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection