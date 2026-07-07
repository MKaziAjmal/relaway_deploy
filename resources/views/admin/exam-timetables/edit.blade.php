@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Edit Exam Timetable</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('exam-timetables.update', $examTimetable->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Exam Type --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exam Type</label>

                        <select name="exam_id"
                                class="form-select @error('exam_id') is-invalid @enderror">

                            @foreach($examTypes as $examType)

                                <option value="{{ $examType->id }}"
                                    {{ old('exam_id', $examTimetable->exam_id) == $examType->id ? 'selected' : '' }}>

                                    {{ $examType->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('exam_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Academic Year --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Academic Year</label>

                        <select name="academic_year_id"
                                class="form-select @error('academic_year_id') is-invalid @enderror">

                            @foreach($academicYears as $year)

                                <option value="{{ $year->id }}"
                                    {{ old('academic_year_id', $examTimetable->academic_year_id) == $year->id ? 'selected' : '' }}>

                                    {{ $year->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Class --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Class</label>

                        <select name="school_class_id"
                                class="form-select @error('school_class_id') is-invalid @enderror">

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}"
                                    {{ old('school_class_id', $examTimetable->school_class_id) == $class->id ? 'selected' : '' }}>

                                    {{ $class->class_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Section --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Section</label>

                        <select name="section_id"
                                class="form-select @error('section_id') is-invalid @enderror">

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old('section_id', $examTimetable->section_id) == $section->id ? 'selected' : '' }}>

                                    {{ $section->section_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Subject --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Subject</label>

                        <select name="subject_id"
                                class="form-select @error('subject_id') is-invalid @enderror">

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $examTimetable->subject_id) == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->subject_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Exam Date --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Exam Date</label>

                        <input type="date"
                               name="exam_date"
                               value="{{ old('exam_date', $examTimetable->exam_date) }}"
                               class="form-control">

                    </div>

                    {{-- Start Time --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Start Time</label>

                        <input type="time"
                               name="start_time"
                               value="{{ old('start_time', $examTimetable->start_time) }}"
                               class="form-control">

                    </div>

                    {{-- End Time --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">End Time</label>

                        <input type="time"
                               name="end_time"
                               value="{{ old('end_time', $examTimetable->end_time) }}"
                               class="form-control">

                    </div>

                    {{-- Room --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Room</label>

                        <input type="text"
                               name="room"
                               value="{{ old('room', $examTimetable->room) }}"
                               class="form-control">

                    </div>

                    {{-- Remarks --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">Remarks</label>

                        <textarea name="remarks"
                                  rows="4"
                                  class="form-control">{{ old('remarks', $examTimetable->remarks) }}</textarea>

                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    Update Timetable
                </button>

                <a href="{{ route('exam-timetables.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection