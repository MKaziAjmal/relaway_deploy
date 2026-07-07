@extends('layouts.teacher')

@section('title', 'View Marks')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-eye"></i> Student Marks</h3>
        <div>
            <a href="{{ route('teacher.marks.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Timetables
            </a>
            <a href="{{ route('teacher.marks.entry', $examTimetable->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Marks
            </a>
            <a href="{{ route('teacher.marks.download', $examTimetable->id) }}" class="btn btn-success">
                <i class="fas fa-download"></i> Download Report
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Exam Details -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Exam Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Exam Type:</strong>
                    <p>{{ $examTimetable->examType->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Class:</strong>
                    <p>{{ $examTimetable->schoolClass->class_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Section:</strong>
                    <p>{{ $examTimetable->section->section_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Subject:</strong>
                    <p>{{ $examTimetable->subject->subject_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Date:</strong>
                    <p>{{ \Carbon\Carbon::parse($examTimetable->exam_date)->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Time:</strong>
                    <p>{{ \Carbon\Carbon::parse($examTimetable->start_time)->format('h:i A') }} - 
                       {{ \Carbon\Carbon::parse($examTimetable->end_time)->format('h:i A') }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Room:</strong>
                    <p>{{ $examTimetable->room ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Total Students:</strong>
                    <p><span class="badge bg-primary">{{ $students->count() }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Marks Table -->
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list"></i> Student Marks</h5>
            <span class="badge bg-light text-dark">
                @php
                    $enteredCount = $students->whereNotNull('obtained_marks')->count();
                @endphp
                {{ $enteredCount }} / {{ $students->count() }} Entered
            </span>
        </div>
        <div class="card-body">

            @if($students->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Roll No</th>
                                <th>Student Name</th>
                                <th>Total Marks</th>
                                <th>Obtained Marks</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $student->roll_no ?? 'N/A' }}</strong>
                                    </td>
                                    <td>{{ $student->student_name ?? 'N/A' }}</td>
                                    <td>{{ $student->total_marks ?? 0 }}</td>
                                    <td>
                                        @if($student->obtained_marks !== null)
                                            <strong class="text-primary">{{ $student->obtained_marks }}</strong>
                                        @else
                                            <span class="badge bg-warning text-dark">Not Entered</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $percentage = ($student->total_marks > 0 && $student->obtained_marks !== null) 
                                                ? round(($student->obtained_marks / $student->total_marks) * 100, 2) 
                                                : 0;
                                        @endphp
                                        @if($student->obtained_marks !== null)
                                            <span class="badge bg-info">{{ $percentage }}%</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->obtained_marks !== null)
                                            @php
                                                $grade = $percentage >= 90 ? 'A+' : 
                                                        ($percentage >= 80 ? 'A' : 
                                                        ($percentage >= 70 ? 'B' : 
                                                        ($percentage >= 60 ? 'C' : 
                                                        ($percentage >= 50 ? 'D' : 
                                                        ($percentage >= 40 ? 'E' : 'F')))));
                                                $color = $percentage >= 70 ? 'success' : 
                                                        ($percentage >= 50 ? 'warning' : 
                                                        ($percentage >= 40 ? 'info' : 'danger'));
                                            @endphp
                                            <span class="badge bg-{{ $color }}">{{ $grade }}</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->obtained_marks !== null)
                                            @if($percentage >= 40)
                                                <span class="badge bg-success">Pass</span>
                                            @else
                                                <span class="badge bg-danger">Fail</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $student->remarks ?? '-' }}</td>
                                    <td>
                                        @if($student->obtained_marks !== null)
                                            <a href="{{ route('teacher.marks.edit', $student->student_id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistics -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h6>Total Students</h6>
                                <h3>{{ $students->count() }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h6>Passed</h6>
                                <h3>
                                    @php
                                        $passed = $students->filter(function($s) {
                                            if ($s->obtained_marks === null) return false;
                                            $p = ($s->total_marks > 0) ? ($s->obtained_marks / $s->total_marks) * 100 : 0;
                                            return $p >= 40;
                                        })->count();
                                    @endphp
                                    {{ $passed }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h6>Failed</h6>
                                <h3>
                                    @php
                                        $failed = $students->filter(function($s) {
                                            if ($s->obtained_marks === null) return false;
                                            $p = ($s->total_marks > 0) ? ($s->obtained_marks / $s->total_marks) * 100 : 0;
                                            return $p < 40;
                                        })->count();
                                    @endphp
                                    {{ $failed }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h6>Not Entered</h6>
                                <h3>
                                    @php
                                        $notEntered = $students->filter(function($s) {
                                            return $s->obtained_marks === null;
                                        })->count();
                                    @endphp
                                    {{ $notEntered }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            @else

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No students found for this exam timetable.
                </div>

            @endif

        </div>
    </div>

</div>

@endsection