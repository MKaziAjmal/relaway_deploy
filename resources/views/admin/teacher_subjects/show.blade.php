@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h3>Teacher Assignment Details</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>Teacher</th>
                    <td>{{ $teacherSubject->teacher->user->name }}</td>
                </tr>

                <tr>
                    <th>Class</th>
                    <td>{{ $teacherSubject->schoolClass->class_name }}</td>
                </tr>

                <tr>
                    <th>Section</th>
                    <td>{{ $teacherSubject->section->section_name }}</td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td>{{ $teacherSubject->subject->subject_name }}</td>
                </tr>

                <tr>
                    <th>Academic Year</th>
                    <td>{{ $teacherSubject->academicYear->name }}</td>
                </tr>

            </table>

            <a href="{{ route('teacher-subjects.index') }}"
               class="btn btn-secondary">
                Back
            </a>

            <a href="{{ route('teacher-subjects.edit', $teacherSubject) }}"
               class="btn btn-warning">
                Edit
            </a>

        </div>

    </div>

</div>

@endsection