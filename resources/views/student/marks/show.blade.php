@extends('layouts.student')

@section('title', 'Mark Details')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-eye"></i> Mark Details</h3>
        <div>
            <a href="{{ route('student.marks.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('student.marks.print', $mark->exam_timetable_id) }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print
            </a>
            <a href="{{ route('student.marks.download-pdf', $mark->exam_timetable_id) }}" class="btn btn-danger">
                <i class="fas fa-download"></i> Download PDF
            </a>
        </div>
    </div>

    <!-- Student Info -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user"></i> Student Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Name:</strong>
                    <p>{{ $student->user->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Admission No:</strong>
                    <p>{{ $student->admission_no ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Class:</strong>
                    <p>{{ $mark->examTimetable->schoolClass->class_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Section:</strong>
                    <p>{{ $mark->examTimetable->section->section_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mark Details -->
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt"></i> Mark Details</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Exam</th>
                            <td>{{ $mark->examTimetable->examType->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $mark->subject->subject_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Exam Date</th>
                            <td>{{ isset($mark->examTimetable->exam_date) ? \Carbon\Carbon::parse($mark->examTimetable->exam_date)->format('d-m-Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Total Marks</th>
                            <td>{{ $mark->total_marks ?? 0 }}</td>
                        </tr>
                        <tr>
                            <th>Obtained Marks</th>
                            <td><strong class="text-primary">{{ $mark->obtained_marks ?? 0 }}</strong></td>
                        </tr>
                        <tr>
                            <th>Percentage</th>
                            <td><span class="badge bg-info">{{ $percentage ?? 0 }}%</span></td>
                        </tr>
                        <tr>
                            <th>Grade</th>
                            <td>
                                <span class="badge bg-{{ $grade['color'] ?? 'secondary' }}">
                                    {{ $grade['letter'] ?? 'N/A' }}
                                </span>
                                <small class="text-muted ms-2">{{ $grade['description'] ?? '' }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($status == 'Pass')
                                    <span class="badge bg-success">Pass</span>
                                @else
                                    <span class="badge bg-danger">Fail</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>{{ $mark->remarks ?? 'No remarks' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <!-- Grade Chart -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Performance Chart</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="progress" style="height: 30px;">
                                <div class="progress-bar bg-{{ $grade['color'] ?? 'secondary' }}" 
                                     role="progressbar" 
                                     style="width: {{ $percentage ?? 0 }}%;" 
                                     aria-valuenow="{{ $percentage ?? 0 }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    {{ $percentage ?? 0 }}%
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="badge bg-success">A+ (90-100%)</span>
                                <span class="badge bg-success">A (80-89%)</span>
                                <span class="badge bg-success">B (70-79%)</span>
                                <span class="badge bg-warning">C (60-69%)</span>
                                <span class="badge bg-warning">D (50-59%)</span>
                                <span class="badge bg-info">E (40-49%)</span>
                                <span class="badge bg-danger">F (Below 40%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection