@extends('layouts.teacher')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h4>Enter Student Marks</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('teacher.marks.store') }}" method="POST">

                @csrf

                <div class="row">

                    {{-- Exam --}}
                    <div class="col-md-3 mb-3">
                        <label>Exam</label>

                        <select name="exam_id" class="form-select" required>

                            <option value="">Select Exam</option>

                            @foreach($examTypes as $exam)

                                <option value="{{ $exam->id }}">
                                    {{ $exam->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Class --}}
                    <div class="col-md-3 mb-3">
                        <label>Class</label>

                        <select name="school_class_id"
                                class="form-select"
                                onchange="this.form.submit()">

                            <option value="">Select Class</option>

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}"
                                    {{ request('school_class_id')==$class->id ? 'selected':'' }}>

                                    {{ $class->class_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Section --}}
                    <div class="col-md-3 mb-3">

                        <label>Section</label>

                        <select name="section_id"
                                class="form-select"
                                onchange="this.form.submit()">

                            <option value="">Select Section</option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ request('section_id')==$section->id ? 'selected':'' }}>

                                    {{ $section->section_name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Subject --}}
                    <div class="col-md-3 mb-3">

                        <label>Subject</label>

                        <select name="subject_id" class="form-select">

                            <option value="">Select Subject</option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}">
                                    {{ $subject->subject_name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                @if(isset($students) && $students->count())

                <hr>

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Roll No</th>

                            <th>Student Name</th>

                            <th>Obtained Marks</th>

                            <th>Total Marks</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($students as $student)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $student->roll_no }}</td>

                            <td>{{ $student->name }}</td>

                            <td>

                                <input type="hidden"
                                       name="student_id[]"
                                       value="{{ $student->id }}">

                                <input type="number"
                                       name="obtained_marks[]"
                                       class="form-control"
                                       required>

                            </td>

                            <td>

                                <input type="number"
                                       name="total_marks[]"
                                       value="100"
                                       class="form-control">

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

                <button class="btn btn-success">

                    Save Marks

                </button>

                @endif

            </form>

        </div>

    </div>

</div>

@endsection