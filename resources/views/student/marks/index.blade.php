@extends('layouts.student')

@section('title', 'My Marks')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-list"></i> My Marks</h3>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('student.performance-card') }}" class="btn btn-success">
                <i class="fas fa-id-card"></i> Performance Card
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Statistics -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h6>Total Marks</h6>
                    <h3>{{ $marks->sum('total_marks') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6>Obtained Marks</h6>
                    <h3>{{ $marks->sum('obtained_marks') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <h6>Average</h6>
                    <h3>
                        @php
                            $total = $marks->sum('total_marks');
                            $obtained = $marks->sum('obtained_marks');
                            $avg = ($total > 0) ? round(($obtained / $total) * 100, 2) : 0;
                        @endphp
                        {{ $avg }}%
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <h6>Total Exams</h6>
                    <h3>{{ $marks->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
<td>
    <div class="btn-group btn-group-sm">
        <a href="{{ route('student.marks.show', $mark->exam_timetable_id) }}" 
           class="btn btn-info" title="View Details">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('student.transcript', $mark->exam_timetable_id) }}" 
           class="btn btn-success" title="Transcript/DMC">
            <i class="fas fa-file-alt"></i>
        </a>
        <a href="{{ route('student.marks.print', $mark->exam_timetable_id) }}" 
           class="btn btn-primary" title="Print" target="_blank">
            <i class="fas fa-print"></i>
        </a>
        <a href="{{ route('student.marks.download-pdf', $mark->exam_timetable_id) }}" 
           class="btn btn-danger" title="Download PDF">
            <i class="fas fa-download"></i>
        </a>
    </div>
</td>
    <!-- Marks Table -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt"></i> All Marks</h5>
        </div>
        <div class="card-body">

            @if($marks->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
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
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marks as $mark)
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
                                        @endphp
                                        <span class="badge bg-info">{{ $percentage }}%</span>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                        @if($percentage >= 40)
                                            <span class="badge bg-success">Pass</span>
                                        @else
                                            <span class="badge bg-danger">Fail</span>
                                        @endif
                                    </td>
                                    <td>{{ $mark->remarks ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('student.marks.show', $mark->exam_timetable_id) }}" 
                                               class="btn btn-info" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('student.marks.print', $mark->exam_timetable_id) }}" 
                                               class="btn btn-primary" title="Print" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="{{ route('student.marks.download-pdf', $mark->exam_timetable_id) }}" 
                                               class="btn btn-danger" title="Download PDF">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
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