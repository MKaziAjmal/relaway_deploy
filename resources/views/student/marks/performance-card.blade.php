@extends('layouts.student')

@section('title', 'Performance Card')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-id-card"></i> Performance Card</h3>
        <div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('student.performance-card.print') }}" class="btn btn-primary" target="_blank">
                <i class="fas fa-print"></i> Print
            </a>
            <a href="{{ route('student.performance-card.download-pdf') }}" class="btn btn-danger">
                <i class="fas fa-download"></i> Download PDF
            </a>
        </div>
    </div>

    <!-- Performance Card -->
    <div class="card shadow" id="performance-card">
        <!-- Header with Institution Name -->
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0"><i class="fas fa-university"></i> School Management System</h3>
            <p class="mb-0">Academic Performance Report</p>
        </div>
        
        <div class="card-body">

            <!-- Report Header -->
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <h4 class="mb-0">Academic Performance Card</h4>
                    <p class="text-muted">
                        <small>Generated on: {{ \Carbon\Carbon::now()->format('l, d-m-Y h:i A') }}</small>
                    </p>
                    <hr>
                </div>
            </div>

            <!-- Student Info -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="fas fa-user-graduate"></i> Student Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Student Name:</strong> 
                                    <span class="text-primary">{{ $student->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Admission No:</strong> 
                                    <span class="text-primary">{{ $student->admission_no ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Roll No:</strong> 
                                    <span class="text-primary">{{ $student->roll_no ?? 'N/A' }}</span>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong>Academic Year:</strong> 
                                    <span class="text-primary">
                                        @php
                                            $academicYear = null;
                                            if($marks->first() && $marks->first()->examTimetable) {
                                                $academicYear = $marks->first()->examTimetable->academicYear;
                                            }
                                        @endphp
                                        @if($academicYear)
                                            {{ $academicYear->name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong>Class:</strong> 
                                    <span class="text-primary">
                                        @if($marks->first() && $marks->first()->examTimetable)
                                            {{ $marks->first()->examTimetable->schoolClass->class_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong>Section:</strong> 
                                    <span class="text-primary">
                                        @if($marks->first() && $marks->first()->examTimetable)
                                            {{ $marks->first()->examTimetable->section->section_name ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <strong>Total Exams:</strong> 
                                    <span class="text-primary">{{ $marks->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exam Type Wise Performance -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0"><i class="fas fa-calendar-alt"></i> Exam Type Wise Performance</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Exam Type</th>
                                            <th>Academic Year</th>
                                            <th>Total Marks</th>
                                            <th>Obtained Marks</th>
                                            <th>Percentage</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $examTypeMarks = [];
                                            foreach($marks as $mark) {
                                                $key = $mark->examTimetable->examType->id ?? 'unknown';
                                                if (!isset($examTypeMarks[$key])) {
                                                    $examTypeMarks[$key] = [
                                                        'name' => $mark->examTimetable->examType->name ?? 'N/A',
                                                        'academic_year' => $mark->examTimetable->academicYear->name ?? 'N/A',
                                                        'total' => 0,
                                                        'obtained' => 0,
                                                        'count' => 0,
                                                    ];
                                                }
                                                $examTypeMarks[$key]['total'] += $mark->total_marks;
                                                $examTypeMarks[$key]['obtained'] += $mark->obtained_marks;
                                                $examTypeMarks[$key]['count']++;
                                            }
                                        @endphp
                                        @if(count($examTypeMarks) > 0)
                                            @foreach($examTypeMarks as $examType)
                                                @php
                                                    $percentage = ($examType['total'] > 0) ? round(($examType['obtained'] / $examType['total']) * 100, 2) : 0;
                                                    $grade = calculateGrade($percentage);
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><strong>{{ $examType['name'] }}</strong></td>
                                                    <td>{{ $examType['academic_year'] }}</td>
                                                    <td>{{ $examType['total'] }}</td>
                                                    <td>{{ $examType['obtained'] }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $percentage }}%</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $grade['color'] ?? 'secondary' }}">
                                                            {{ $grade['letter'] ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($percentage >= 40)
                                                            <span class="badge bg-success">Pass</span>
                                                        @else
                                                            <span class="badge bg-danger">Fail</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">No exam type data available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subject Wise Marks -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-success">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0"><i class="fas fa-book"></i> Subject Wise Performance</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Academic Year</th>
                                            <th>Total Marks</th>
                                            <th>Obtained Marks</th>
                                            <th>Percentage</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($subjectMarks) && count($subjectMarks) > 0)
                                            @foreach($subjectMarks as $subject)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><strong>{{ $subject['subject_name'] }}</strong></td>
                                                    <td>{{ $subject['academic_year'] ?? 'N/A' }}</td>
                                                    <td>{{ $subject['total'] }}</td>
                                                    <td>{{ $subject['obtained'] }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $subject['percentage'] }}%</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $subject['grade']['color'] ?? 'secondary' }}">
                                                            {{ $subject['grade']['letter'] ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($subject['percentage'] >= 40)
                                                            <span class="badge bg-success">Pass</span>
                                                        @else
                                                            <span class="badge bg-danger">Fail</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">No subject data available</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Summary -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-chart-bar"></i> Overall Summary</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <h6 class="text-muted">Total Marks</h6>
                                    <h3 class="text-primary">{{ $totalMarks ?? 0 }}</h3>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h6 class="text-muted">Obtained Marks</h6>
                                    <h3 class="text-success">{{ $obtainedMarks ?? 0 }}</h3>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h6 class="text-muted">Overall Percentage</h6>
                                    <h3>
                                        <span class="badge bg-info fs-5">{{ $overallPercentage ?? 0 }}%</span>
                                    </h3>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h6 class="text-muted">Overall Grade</h6>
                                    <h3>
                                        <span class="badge bg-{{ $overallGrade['color'] ?? 'secondary' }} fs-5">
                                            {{ $overallGrade['letter'] ?? 'N/A' }}
                                        </span>
                                    </h3>
                                    <small class="text-muted">{{ $overallGrade['description'] ?? '' }}</small>
                                </div>
                            </div>
                            
                            <!-- Performance Bar -->
                            <div class="mt-3">
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-{{ $overallGrade['color'] ?? 'secondary' }}" 
                                         role="progressbar" 
                                         style="width: {{ $overallPercentage ?? 0 }}%;" 
                                         aria-valuenow="{{ $overallPercentage ?? 0 }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        {{ $overallPercentage ?? 0 }}%
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted">0%</small>
                                    <small class="text-muted">100%</small>
                                </div>
                            </div>
                            
                            <!-- Grade Scale -->
                            <div class="mt-3">
                                <small class="text-muted">Grade Scale:</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-success">A+ (90-100%)</span>
                                    <span class="badge bg-success">A (80-89%)</span>
                                    <span class="badge bg-success">B (70-79%)</span>
                                    <span class="badge bg-warning text-dark">C (60-69%)</span>
                                    <span class="badge bg-warning text-dark">D (50-59%)</span>
                                    <span class="badge bg-info">E (40-49%)</span>
                                    <span class="badge bg-danger">F (Below 40%)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <hr>
                    <p class="text-muted mb-0">
                        <small>This is a computer generated document. No signature required.</small>
                    </p>
                    <p class="text-muted mb-0">
                        <small>Generated on {{ \Carbon\Carbon::now()->format('l, d-m-Y h:i A') }}</small>
                    </p>
                    <p class="text-muted mb-0">
                        <small>&copy; {{ \Carbon\Carbon::now()->format('Y') }} School Management System. All rights reserved.</small>
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection

@php
function calculateGrade($percentage) {
    if ($percentage >= 90) {
        return ['letter' => 'A+', 'color' => 'success', 'description' => 'Outstanding'];
    } elseif ($percentage >= 80) {
        return ['letter' => 'A', 'color' => 'success', 'description' => 'Excellent'];
    } elseif ($percentage >= 70) {
        return ['letter' => 'B', 'color' => 'success', 'description' => 'Very Good'];
    } elseif ($percentage >= 60) {
        return ['letter' => 'C', 'color' => 'warning', 'description' => 'Good'];
    } elseif ($percentage >= 50) {
        return ['letter' => 'D', 'color' => 'warning', 'description' => 'Fair'];
    } elseif ($percentage >= 40) {
        return ['letter' => 'E', 'color' => 'info', 'description' => 'Pass'];
    } else {
        return ['letter' => 'F', 'color' => 'danger', 'description' => 'Fail'];
    }
}
@endphp

<style>
@media print {
    .no-print { display: none !important; }
    .card { border: 1px solid #ddd !important; }
    .card-header { background: #007bff !important; color: white !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .card-body { padding: 15px !important; }
    .table { font-size: 12px !important; }
    .badge { font-size: 10px !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .progress { height: 20px !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .progress-bar { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .btn { display: none !important; }
    .navbar { display: none !important; }
    .alert { display: none !important; }
    .dropdown { display: none !important; }
    .container-fluid { padding: 0 !important; }
    body { padding: 10px !important; margin: 0 !important; }
    .no-print-btn { display: none !important; }
    #performance-card { border: none !important; box-shadow: none !important; }
    .card { box-shadow: none !important; }
    .shadow { box-shadow: none !important; }
}
</style>