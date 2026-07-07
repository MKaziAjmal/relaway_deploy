@extends('layouts.teacher')

@section('title', 'Teacher Marks')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-list"></i> My Exam Timetables</h3>
        <div>
            <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('teacher.marks.student-list') }}" class="btn btn-info">
                <i class="fas fa-users"></i> All Student Marks
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

    <!-- Search and Filter -->
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('teacher.marks.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search exam or subject..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="exam_id" class="form-select">
                        <option value="">All Exams</option>
                        @foreach($exams ?? [] as $exam)
                            <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                {{ $exam->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h6 class="mb-0">Total Timetables</h6>
                    <h3 class="mb-0">{{ $examTimetables->total() ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6 class="mb-0">Completed</h6>
                    <h3 class="mb-0">
                        @php
                            $completed = 0;
                            foreach($examTimetables as $t) {
                                if($t->marks && $t->marks->count() > 0) $completed++;
                            }
                        @endphp
                        {{ $completed }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow-sm">
                <div class="card-body">
                    <h6 class="mb-0">Pending</h6>
                    <h3 class="mb-0">
                        @php
                            $pending = 0;
                            foreach($examTimetables as $t) {
                                if(!$t->marks || $t->marks->count() == 0) $pending++;
                            }
                        @endphp
                        {{ $pending }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow-sm">
                <div class="card-body">
                    <h6 class="mb-0">Total Students</h6>
                    <h3 class="mb-0">
                        @php
                            $totalStudents = 0;
                            foreach($examTimetables as $t) {
                                $totalStudents += $t->marks ? $t->marks->count() : 0;
                            }
                        @endphp
                        {{ $totalStudents }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Timetables Table -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Assigned Exam Timetables</h5>
        </div>
        <div class="card-body">

            @if($examTimetables->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
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
                            @foreach($examTimetables as $timetable)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($timetable->exam)
                                            <span class="badge bg-info">{{ $timetable->exam->name ?? 'N/A' }}</span>
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
                                            <strong>{{ $timetable->subject->subject_name ?? 'N/A' }}</strong>
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
                                            <br>
                                            <small>{{ $timetable->marks->count() }} students</small>
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
                                            <a href="{{ route('teacher.marks.download', $timetable->id) }}" 
                                               class="btn btn-primary" title="Download Report">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @if($hasMarks)
                                                <form action="{{ route('teacher.marks.destroyAll', $timetable->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" 
                                                            onclick="return confirm('Delete all marks for this exam?')"
                                                            title="Delete All Marks">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $examTimetables->links() }}

            @else

                <div class="alert alert-info mb-0">
                    <i class="fas fa-info-circle"></i> No exam timetables assigned to you.
                </div>

            @endif

        </div>
    </div>

</div>

@endsection