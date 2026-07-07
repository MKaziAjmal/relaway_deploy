@extends('layouts.teacher')

@section('content')

<div class="container-fluid">

    <!-- Stats Cards -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5>My Subjects</h5>
                    <h2>{{ $subjects ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5>My Classes</h5>
                    <h2>{{ $classes ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5>Today's Exams</h5>
                    <h2>{{ $todayExams ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5>Pending Marks</h5>
                    <h2>{{ $pendingMarks ?? 0 }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Quick Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-bolt"></i> Quick Actions</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('teacher.marks.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> All Exam Timetables
                        </a>
                        @if(Route::has('teacher.marks.student-list'))
                            <a href="{{ route('teacher.marks.student-list') }}" class="btn btn-info">
                                <i class="fas fa-users"></i> All Student Marks
                            </a>
                        @endif
                        @if($todayTimetable->count() > 0)
                            <a href="{{ route('teacher.marks.entry', $todayTimetable->first()->id) }}" class="btn btn-success">
                                <i class="fas fa-edit"></i> Enter Marks (Today)
                            </a>
                            <a href="{{ route('teacher.marks.show', $todayTimetable->first()->id) }}" class="btn btn-warning">
                                <i class="fas fa-eye"></i> View Today's Marks
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today's Exam Timetable -->
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-calendar-day"></i> Today's Exam Timetable</h4>
            <div>
                <a href="{{ route('teacher.marks.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list"></i> All Timetables
                </a>
                @if($todayTimetable->count() > 0)
                    <a href="{{ route('teacher.marks.show', $todayTimetable->first()->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> View Marks
                    </a>
                    <a href="{{ route('teacher.marks.entry', $todayTimetable->first()->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-edit"></i> Enter Marks
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">

            @if($todayTimetable->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayTimetable as $timetable)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($timetable->examType)
                                            {{ $timetable->examType->name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Exam (ID: {{ $timetable->exam_id ?? 'NULL' }})</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($timetable->schoolClass)
                                            {{ $timetable->schoolClass->class_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Class</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($timetable->section)
                                            {{ $timetable->section->section_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Section</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($timetable->subject)
                                            {{ $timetable->subject->subject_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Subject</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($timetable->exam_date)->format('d-m-Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}
                                    </td>
                                    <td>{{ $timetable->room ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $hasMarks = $timetable->marks && $timetable->marks->count() > 0;
                                        @endphp
                                        @if($hasMarks)
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if($hasMarks)
                                                <a href="{{ route('teacher.marks.show', $timetable->id) }}" 
                                                   class="btn btn-info" title="View Marks">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('teacher.marks.entry', $timetable->id) }}" 
                                                   class="btn btn-warning" title="Edit Marks">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('teacher.marks.entry', $timetable->id) }}" 
                                                   class="btn btn-success" title="Enter Marks">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('teacher.marks.index') }}" 
                                               class="btn btn-primary" title="View All">
                                                <i class="fas fa-list"></i>
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
                    <i class="fas fa-info-circle"></i> No exams scheduled for today.
                </div>

            @endif

        </div>
    </div>

    <!-- Upcoming Exams -->
    <div class="card shadow mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="fas fa-calendar-alt"></i> Upcoming Exams</h4>
            <a href="{{ route('teacher.marks.index') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-list"></i> View All
            </a>
        </div>
        <div class="card-body">

            @if($upcomingTimetable->count() > 0)

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Room</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingTimetable as $exam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($exam->examType)
                                            {{ $exam->examType->name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Exam</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exam->schoolClass)
                                            {{ $exam->schoolClass->class_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Class</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exam->section)
                                            {{ $exam->section->section_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Section</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($exam->subject)
                                            {{ $exam->subject->subject_name ?? 'N/A' }}
                                        @else
                                            <span class="text-danger">No Subject</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d-m-Y') }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($exam->start_time)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($exam->end_time)->format('h:i A') }}
                                    </td>
                                    <td>{{ $exam->room ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('teacher.marks.entry', $exam->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Enter Marks
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle"></i> No upcoming exams.
                </div>

            @endif

        </div>
    </div>

   <!-- Quick Marks Entry Section -->
<div class="card shadow mt-4">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-edit"></i> Quick Marks Entry</h5>
    </div>
    <div class="card-body">

        @if(isset($quickEntryExams) && $quickEntryExams->count() > 0)

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Exam</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quickEntryExams as $exam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $exam->examType->name ?? 'N/A' }}</td>
                                <td>{{ $exam->schoolClass->class_name ?? 'N/A' }}</td>
                                <td>{{ $exam->section->section_name ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $exam->subject->subject_name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @php
                                        $hasMarks = $exam->marks && $exam->marks->count() > 0;
                                    @endphp
                                    @if($hasMarks)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @if($hasMarks)
                                            <a href="{{ route('teacher.marks.show', $exam->id) }}" 
                                               class="btn btn-info" title="View Marks">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('teacher.marks.entry', $exam->id) }}" 
                                               class="btn btn-warning" title="Edit Marks">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('teacher.marks.entry', $exam->id) }}" 
                                               class="btn btn-success" title="Enter Marks">
                                                <i class="fas fa-plus"></i> Enter
                                            </a>
                                        @endif
                                        <a href="{{ route('teacher.marks.download', $exam->id) }}" 
                                           class="btn btn-primary" title="Download Report">
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
                <i class="fas fa-info-circle"></i> No exams available for quick marks entry.
                <a href="{{ route('teacher.marks.index') }}" class="alert-link">View all timetables</a>
            </div>

        @endif

    </div>
</div>
    <!-- Quick Navigation Menu -->
    <div class="card shadow mt-4">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-compass"></i> Quick Navigation</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card border-primary h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-3x text-primary mb-2"></i>
                            <h6>All Timetables</h6>
                            <p class="text-muted small">View all assigned exam timetables</p>
                            <a href="{{ route('teacher.marks.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-arrow-right"></i> Go
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-success h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-edit fa-3x text-success mb-2"></i>
                            <h6>Enter Marks</h6>
                            <p class="text-muted small">Enter marks for students</p>
                            @if($todayTimetable->count() > 0)
                                <a href="{{ route('teacher.marks.entry', $todayTimetable->first()->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-right"></i> Go
                                </a>
                            @elseif($upcomingTimetable->count() > 0)
                                <a href="{{ route('teacher.marks.entry', $upcomingTimetable->first()->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-right"></i> Go (Next Exam)
                                </a>
                            @else
                                <a href="{{ route('teacher.marks.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-right"></i> View Timetables
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-info h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-info mb-2"></i>
                            <h6>Student Marks</h6>
                            <p class="text-muted small">View all student marks</p>
                            <a href="{{ route('teacher.marks.student-list') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-arrow-right"></i> Go
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-warning h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-download fa-3x text-warning mb-2"></i>
                            <h6>Download Reports</h6>
                            <p class="text-muted small">Download marks reports</p>
                            @if($todayTimetable->count() > 0)
                                <a href="{{ route('teacher.marks.download', $todayTimetable->first()->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-arrow-right"></i> Go
                                </a>
                            @else
                                <a href="{{ route('teacher.marks.index') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-arrow-right"></i> View Timetables
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection