@extends('layouts.admin')

@section('content')

<div class="container">

    {{-- CLASS SELECT FORM --}}
    <form method="GET" action="{{ route('exam-timetables.create') }}">

        <div class="card shadow">
            <div class="card-header">
                <h4>Create Exam Timetable</h4>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Class</label>

                        <select name="school_class_id"
                                class="form-select"
                                onchange="this.form.submit()">

                            <option value="">Select Class</option>

                            @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ (isset($selectedClass) && $selectedClass == $class->id) ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                </div>

            </div>
        </div>

    </form>

    {{-- MAIN FORM --}}
    <form method="POST" action="{{ route('exam-timetables.store') }}">
        @csrf

        <input type="hidden" name="school_class_id" value="{{ $selectedClass ?? '' }}">

        <div class="card shadow mt-3">
            <div class="card-body">

                <div class="row">

                    {{-- EXAM TYPE --}}
                    <div class="col-md-6 mb-3">
                        <select name="exam_id" class="form-select">
                            <option value="">Select Exam Type</option>
                            @foreach($examTypes as $examType)
                                <option value="{{ $examType->id }}">
                                    {{ $examType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ACADEMIC YEAR --}}
                    <div class="col-md-6 mb-3">
                        <select name="academic_year_id" class="form-select">
                            <option value="">Select Academic Year</option>
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}">
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SECTION --}}
                    <div class="col-md-6 mb-3">
                        <select name="section_id" class="form-select">
                            <option value="">Select Section</option>

                            @forelse($sections ?? [] as $section)
                                <option value="{{ $section->id }}">
                                    {{ $section->section_name }}
                                </option>
                            @empty
                                <option disabled>No sections available</option>
                            @endforelse

                        </select>
                    </div>

                    {{-- SUBJECT --}}
                    <div class="col-md-6 mb-3">
                        <select name="subject_id" class="form-select">
                            <option value="">Select Subject</option>

                            @forelse($subjects ?? [] as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ $subject->subject_name }}
                                </option>
                            @empty
                                <option disabled>No subjects available</option>
                            @endforelse

                        </select>
                    </div>

                    {{-- DATE --}}
                    <div class="col-md-6 mb-3">
                        <input type="date" name="exam_date" class="form-control">
                    </div>

                    {{-- TIME --}}
                    <div class="col-md-3 mb-3">
                        <input type="time" name="start_time" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <input type="time" name="end_time" class="form-control">
                    </div>

                    {{-- ROOM --}}
                    <div class="col-md-6 mb-3">
                        <input type="text" name="room" class="form-control" placeholder="Room">
                    </div>

                    {{-- REMARKS --}}
                    <div class="col-md-12 mb-3">
                        <textarea name="remarks" class="form-control" placeholder="Remarks"></textarea>
                    </div>

                </div>

                <button class="btn btn-primary">
                    Save Timetable
                </button>

            </div>
        </div>

    </form>

</div>

@endsection