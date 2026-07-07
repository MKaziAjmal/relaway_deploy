<!DOCTYPE html>
<html>
<head>
    <title>Performance Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; margin: 0; }
            .container { max-width: 100% !important; padding: 20px !important; }
            .card { border: 1px solid #ddd !important; margin-bottom: 15px !important; }
            .card-header { background: #007bff !important; color: white !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .badge { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .bg-success { background: #28a745 !important; }
            .bg-danger { background: #dc3545 !important; }
            .bg-info { background: #17a2b8 !important; }
            .bg-warning { background: #ffc107 !important; color: #333 !important; }
            .bg-primary { background: #007bff !important; }
            .table { font-size: 12px !important; }
            .table th { background: #343a40 !important; color: white !important; }
            .btn { display: none !important; }
            .navbar { display: none !important; }
            .alert { display: none !important; }
            .dropdown { display: none !important; }
            .container-fluid { padding: 0 !important; }
            body { padding: 10px !important; margin: 0 !important; }
            .progress { height: 20px !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .progress-bar { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .card-body { padding: 15px !important; }
            .text-primary { color: #007bff !important; }
            .text-success { color: #28a745 !important; }
            .text-muted { color: #6c757d !important; }
        }
        body { padding: 20px; font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { border: 1px solid #ddd; margin-bottom: 20px; border-radius: 8px; overflow: hidden; }
        .card-header { padding: 12px 20px; font-weight: bold; }
        .card-body { padding: 20px; background: white; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .table th { background: #f8f9fa; font-weight: 600; }
        .table-dark th { background: #343a40; color: white; }
        .badge { padding: 5px 10px; border-radius: 4px; color: white; font-size: 12px; }
        .badge-success { background: #28a745; }
        .badge-danger { background: #dc3545; }
        .badge-info { background: #17a2b8; }
        .badge-warning { background: #ffc107; color: #333; }
        .badge-primary { background: #007bff; }
        .badge-secondary { background: #6c757d; }
        .text-center { text-align: center; }
        .mt-3 { margin-top: 15px; }
        .mt-4 { margin-top: 20px; }
        .mb-3 { margin-bottom: 15px; }
        .mb-4 { margin-bottom: 20px; }
        .mb-0 { margin-bottom: 0; }
        .text-muted { color: #6c757d; }
        .text-primary { color: #007bff; }
        .text-success { color: #28a745; }
        .shadow { box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); }
        .border-bottom { border-bottom: 1px solid #ddd; }
        .pb-3 { padding-bottom: 15px; }
        .border-primary { border-color: #007bff !important; }
        .border-success { border-color: #28a745 !important; }
        .border-info { border-color: #17a2b8 !important; }
        .border-warning { border-color: #ffc107 !important; }
        .mt-2 { margin-top: 10px; }
        .p-0 { padding: 0; }
        .gap-1 { gap: 5px; }
        .d-flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .justify-content-between { justify-content: space-between; }
        .mt-1 { margin-top: 5px; }
        .fs-5 { font-size: 1.25rem; }
        .progress { height: 25px; background: #e9ecef; border-radius: 5px; overflow: hidden; }
        .progress-bar { height: 100%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-4 border-bottom pb-3">
            <h2 class="text-primary"><i class="fas fa-university"></i> School Management System</h2>
            <h4>Academic Performance Card</h4>
            <p>Generated on: {{ \Carbon\Carbon::now()->format('l, d-m-Y h:i A') }}</p>
            <hr>
        </div>

        <!-- Student Info -->
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Student Information</h5>
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

        <!-- Exam Type Wise Performance -->
        <div class="card border-warning">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Exam Type Wise Performance</h5>
            </div>
            <div class="card-body p-0">
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
                                        <span class="badge badge-info">{{ $percentage }}%</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $grade['color'] ?? 'secondary' }}">
                                            {{ $grade['letter'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($percentage >= 40)
                                            <span class="badge badge-success">Pass</span>
                                        @else
                                            <span class="badge badge-danger">Fail</span>
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

        <!-- Subject Marks -->
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-book"></i> Subject Wise Performance</h5>
            </div>
            <div class="card-body p-0">
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
                                        <span class="badge badge-info">{{ $subject['percentage'] }}%</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $subject['grade']['color'] ?? 'secondary' }}">
                                            {{ $subject['grade']['letter'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($subject['percentage'] >= 40)
                                            <span class="badge badge-success">Pass</span>
                                        @else
                                            <span class="badge badge-danger">Fail</span>
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

        <!-- Overall Summary -->
        <div class="card border-info">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Overall Summary</h5>
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
                            <span class="badge badge-info fs-5">{{ $overallPercentage ?? 0 }}%</span>
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
                
                <div class="mt-3">
                    <div class="progress">
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
                        <span class="badge badge-success">A+ (90-100%)</span>
                        <span class="badge badge-success">A (80-89%)</span>
                        <span class="badge badge-success">B (70-79%)</span>
                        <span class="badge badge-warning">C (60-69%)</span>
                        <span class="badge badge-warning">D (50-59%)</span>
                        <span class="badge badge-info">E (40-49%)</span>
                        <span class="badge badge-danger">F (Below 40%)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-4">
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

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">Print</button>
            <a href="{{ route('student.performance-card') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
</html>

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