@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">

            <h3>Edit Enrollment</h3>

        </div>

        <div class="card-body">

            <form action="{{ route('student-enrollments.update', $studentEnrollment) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">Student</label>

                    <select name="student_id" class="form-select">

                        @foreach($students as $student)

                            <option value="{{ $student->id }}"
                                {{ $studentEnrollment->student_id == $student->id ? 'selected' : '' }}>

                                {{ $student->user->name }}
                                ({{ $student->admission_no }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">Academic Year</label>

                    <select name="academic_year_id"
                            class="form-select">

                        @foreach($academicYears as $year)

                            <option value="{{ $year->id }}"
                                {{ $studentEnrollment->academic_year_id == $year->id ? 'selected' : '' }}>

                              {{ $year->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Class Section

                    </label>

                    <select name="class_section_id"
                            class="form-select">

                        @foreach($classSections as $item)

                            <option value="{{ $item->id }}"
                                {{ $studentEnrollment->class_section_id == $item->id ? 'selected' : '' }}>

                                {{ $item->schoolClass->class_name }}

                                -

                                {{ $item->section->section_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Roll No

                    </label>

                    <input type="text"
                           name="roll_no"
                           value="{{ $studentEnrollment->roll_no }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status"
                            class="form-select">

                        @foreach(['Active','Promoted','Graduated','Transferred','Left'] as $status)

                            <option value="{{ $status }}"
                                {{ $studentEnrollment->status == $status ? 'selected' : '' }}>

                                {{ $status }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('student-enrollments.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection