@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Teacher Assignment</h3>
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

            <form action="{{ route('teacher-subjects.update', $teacherSubject) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Teacher --}}
                <div class="mb-3">
                    <label class="form-label">Teacher</label>

                    <select name="teacher_id" class="form-select" required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $teacherSubject->teacher_id == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Class --}}
                <div class="mb-3">
                    <label class="form-label">Class</label>

                    <select name="school_class_id" class="form-select" required>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}"
                                {{ $teacherSubject->school_class_id == $class->id ? 'selected' : '' }}>

                                {{ $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Section --}}
                <div class="mb-3">
                    <label class="form-label">Section</label>

                    <select name="section_id" class="form-select" required>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}"
                                {{ $teacherSubject->section_id == $section->id ? 'selected' : '' }}>

                                {{ $section->section_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Subject --}}
                <div class="mb-3">
                    <label class="form-label">Subject</label>

                    <select name="subject_id" class="form-select" required>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ $teacherSubject->subject_id == $subject->id ? 'selected' : '' }}>

                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Academic Year --}}
                <div class="mb-3">
                    <label class="form-label">Academic Year</label>

                    <select name="academic_year_id" class="form-select" required>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}"
                                {{ $teacherSubject->academic_year_id == $year->id ? 'selected' : '' }}>

                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">
                    Update
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