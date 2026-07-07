@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')

<div class="container-fluid">

    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-gradient-primary text-white shadow">
                <div class="card-body">
                    <h3>Welcome, {{ $student->user->name ?? 'Student' }}!</h3>
                    <p class="mb-0">Here's your academic performance overview.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h6><i class="fas fa-book"></i> Subjects</h6>
                    <h2>{{ $subjectsCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h6><i class="fas fa-file-alt"></i> Exams</h6>
                    <h2>{{ $examsCount ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h6><i class="fas fa-percent"></i> Average</h6>
                    <h2>{{ $averagePercentage ?? 0 }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">
                    <h6><i class="fas fa-graduation-cap"></i> Grade</h6>
                    <h2>
                        <span class="badge bg-{{ $grade['color'] ?? 'secondary' }} fs-4">
                            {{ $grade['letter'] ?? 'N/A' }}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-bolt"></i> Quick Actions</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('student.marks.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> View All Marks
                        </a>
                        <a href="{{ route('student.performance-card') }}" class="btn btn-success">
                            <i class="fas fa-id-card"></i> Performance Card
                        </a>
                        <a href="{{ route('student.performance-card.print') }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-print"></i> Print Performance Card
                        </a>
                        <a href="{{ route('student.performance-card.download-pdf') }}" class="btn btn-danger">
                            <i class="fas fa-download"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Marks -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-history"></i> Recent Marks</h5>
            <a href="{{ route('student.marks.index') }}" class="btn btn-light btn-sm">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="card-body">

            @if(isset($recentMarks) && $recentMarks->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Subject</th>
                                <th>Total</th>
                                <th>Obtained</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMarks as $mark)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mark->examTimetable->examType->name ?? 'N/A' }}</td>
                                    <td>{{ $mark->subject->subject_name ?? 'N/A' }}</td>
                                    <td>{{ $mark->total_marks ?? 0 }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $mark->obtained_marks ?? 0 }}</strong>
                                    </td>
                                    <td>
                                        @php
                                            $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
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
                                        <span class="badge bg-info">{{ $percentage }}%</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $color }}">{{ $grade }}</span>
                                    </td>
                                    <td>
                                        @if($percentage >= 40)
                                            <span class="badge bg-success">Pass</span>
                                        @else
                                            <span class="badge bg-danger">Fail</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('student.marks.show', $mark->exam_timetable_id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle"></i> No marks available yet.
                </div>

            @endif

        </div>
    </div>

</div>

@endsection