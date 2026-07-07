@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3>Enrollment Details</h3>

            <a href="{{ route('student-enrollments.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Student</th>
                    <td>{{ $studentEnrollment->student->user->name }}</td>
                </tr>

                <tr>
                    <th>Admission No</th>
                    <td>{{ $studentEnrollment->student->admission_no }}</td>
                </tr>

                <tr>
                    <th>Academic Year</th>
                    <td>{{ $studentEnrollment->academicYear->name }}</td>
                </tr>

                <tr>
                    <th>Class</th>
                    <td>{{ $studentEnrollment->classSection->schoolClass->class_name }}</td>
                </tr>

                <tr>
                    <th>Section</th>
                    <td>{{ $studentEnrollment->classSection->section->section_name }}</td>
                </tr>

                <tr>
                    <th>Roll No</th>
                    <td>{{ $studentEnrollment->roll_no }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-success">
                            {{ $studentEnrollment->status }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $studentEnrollment->created_at->format('d M Y') }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection