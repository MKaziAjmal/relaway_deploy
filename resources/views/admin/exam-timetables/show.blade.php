@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Exam Timetable Details
            </h4>

            <a href="{{ route('exam-timetables.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="250">Exam</th>
                    <td>{{ $examTimetable->exam->title }}</td>
                </tr>

                <tr>
                    <th>Academic Year</th>
                    <td>{{ $examTimetable->academicYear->name }}</td>
                </tr>

                <tr>
                    <th>Class</th>
                    <td>{{ $examTimetable->schoolClass->name }}</td>
                </tr>

                <tr>
                    <th>Section</th>
                    <td>{{ $examTimetable->section->name }}</td>
                </tr>

                <tr>
                    <th>Subject</th>
                    <td>{{ $examTimetable->subject->name }}</td>
                </tr>

                <tr>
                    <th>Exam Date</th>
                    <td>{{ \Carbon\Carbon::parse($examTimetable->exam_date)->format('d M Y') }}</td>
                </tr>

                <tr>
                    <th>Start Time</th>
                    <td>{{ \Carbon\Carbon::parse($examTimetable->start_time)->format('h:i A') }}</td>
                </tr>

                <tr>
                    <th>End Time</th>
                    <td>{{ \Carbon\Carbon::parse($examTimetable->end_time)->format('h:i A') }}</td>
                </tr>

                <tr>
                    <th>Room</th>
                    <td>{{ $examTimetable->room ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Remarks</th>
                    <td>{{ $examTimetable->remarks ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $examTimetable->created_at->format('d M Y h:i A') }}</td>
                </tr>

                <tr>
                    <th>Updated At</th>
                    <td>{{ $examTimetable->updated_at->format('d M Y h:i A') }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection