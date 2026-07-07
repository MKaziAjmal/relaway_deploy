<!DOCTYPE html>
<html>
<head>
    <title>Mark Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; }
            .container { max-width: 100% !important; padding: 20px !important; }
            .card { border: 1px solid #ddd !important; }
            .card-header { background: #007bff !important; color: white !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .badge { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
        body { padding: 20px; font-family: Arial, sans-serif; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { border: 1px solid #ddd; margin-bottom: 20px; border-radius: 8px; overflow: hidden; }
        .card-header { padding: 12px 20px; font-weight: bold; }
        .card-body { padding: 20px; background: white; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        .table th { background: #f8f9fa; font-weight: 600; }
        .badge { padding: 5px 10px; border-radius: 4px; color: white; font-size: 12px; }
        .badge-success { background: #28a745; }
        .badge-danger { background: #dc3545; }
        .badge-info { background: #17a2b8; }
        .badge-primary { background: #007bff; }
        .badge-warning { background: #ffc107; color: #333; }
        .text-center { text-align: center; }
        .mt-4 { margin-top: 20px; }
        .mb-4 { margin-bottom: 20px; }
        .mb-0 { margin-bottom: 0; }
        .text-muted { color: #6c757d; }
        .text-primary { color: #007bff; }
        .text-success { color: #28a745; }
        .shadow { box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); }
        .border-bottom { border-bottom: 1px solid #ddd; }
        .pb-3 { padding-bottom: 15px; }
        .pt-3 { padding-top: 15px; }
        .mt-3 { margin-top: 15px; }
        .bg-light { background: #f8f9fa; }
        .bg-primary { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="text-center mb-4 border-bottom pb-3">
            <h2 class="text-primary"><i class="fas fa-university"></i> School Management System</h2>
            <h4>Detailed Marks Certificate (DMC)</h4>
            <p class="text-muted">Generated on: {{ \Carbon\Carbon::now()->format('l, d-m-Y h:i A') }}</p>
        </div>

        <!-- Exam Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Exam Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Exam Name:</strong> 
                        <span class="text-primary">{{ $mark->examTimetable->examType->name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong>Academic Year:</strong> 
                        <span class="text-primary">{{ $mark->examTimetable->academicYear->name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-4">
                        <strong>Exam Date:</strong> 
                        <span class="text-primary">{{ isset($mark->examTimetable->exam_date) ? \Carbon\Carbon::parse($mark->examTimetable->exam_date)->format('d-m-Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Info -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
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
                        <strong>Class:</strong> 
                        <span class="text-primary">{{ $mark->examTimetable->schoolClass->class_name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-4 mt-2">
                        <strong>Section:</strong> 
                        <span class="text-primary">{{ $mark->examTimetable->section->section_name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-md-4 mt-2">
                        <strong>Subject:</strong> 
                        <span class="text-primary">{{ $mark->subject->subject_name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mark Details -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-list"></i> Mark Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th width="200">Exam Name</th>
                            <td><strong>{{ $mark->examTimetable->examType->name ?? 'N/A' }}</strong></td>
                        </tr>
                        <tr>
                            <th>Academic Year</th>
                            <td>{{ $mark->examTimetable->academicYear->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $mark->subject->subject_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>{{ $mark->examTimetable->schoolClass->class_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $mark->examTimetable->section->section_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Exam Date</th>
                            <td>{{ isset($mark->examTimetable->exam_date) ? \Carbon\Carbon::parse($mark->examTimetable->exam_date)->format('d-m-Y') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Total Marks</th>
                            <td><strong>{{ $mark->total_marks ?? 0 }}</strong></td>
                        </tr>
                        <tr>
                            <th>Obtained Marks</th>
                            <td><strong class="text-primary">{{ $mark->obtained_marks ?? 0 }}</strong></td>
                        </tr>
                        <tr>
                            <th>Percentage</th>
                            <td>
                                <span class="badge bg-info">{{ $percentage ?? 0 }}%</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Grade</th>
                            <td>
                                <span class="badge bg-{{ $grade['color'] ?? 'secondary' }}">
                                    {{ $grade['letter'] ?? 'N/A' }}
                                </span>
                                <span class="text-muted ms-2">({{ $grade['description'] ?? '' }})</span>
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
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Performance Bar -->
        <div class="card mt-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Performance Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
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
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">0%</small>
                            <small class="text-muted">100%</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <small class="text-muted">Grade Scale:</small>
                        <div class="d-flex flex-wrap gap-1 mt-1">
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
            <a href="{{ route('student.marks.show', $mark->exam_timetable_id) }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
</html>