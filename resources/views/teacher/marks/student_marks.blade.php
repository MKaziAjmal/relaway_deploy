@extends('layouts.teacher')

@section('title', 'All Student Marks')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-users"></i> All Student Marks</h3>
        <div>
            <a href="{{ route('teacher.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
            <a href="{{ route('teacher.marks.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> Timetables
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
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('teacher.marks.student-list') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search student, subject or exam..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="exam_id" class="form-select">
                        <option value="">All Exams</option>
                        @foreach($examTypes ?? [] as $exam)
                            <option value="{{ $exam->id }}" {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                {{ $exam->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="class_id" class="form-select">
                        <option value="">All Classes</option>
                        @foreach($classes ?? [] as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->class_name }}
                            </option>
                        @endforeach
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

    <!-- Marks Table -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-list"></i> Student Marks</h5>
            <span class="badge bg-light text-dark">Total: {{ $marks->total() ?? 0 }}</span>
        </div>
        <div class="card-body">

            @if(isset($marks) && $marks->count() > 0)

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Roll No</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Exam</th>
                                <th>Total</th>
                                <th>Obtained</th>
                                <th>Percentage</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marks as $mark)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>
                                            @if($mark->student && $mark->student->user)
                                                {{ $mark->student->user->name }}
                                            @elseif($mark->student_name)
                                                {{ $mark->student_name }}
                                            @else
                                                N/A
                                            @endif
                                        </strong>
                                    </td>
                                    <td>
                                        @if($mark->student)
                                            {{ $mark->student->roll_no ?? 'N/A' }}
                                        @else
                                            {{ $mark->roll_no ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($mark->examTimetable && $mark->examTimetable->schoolClass)
                                            {{ $mark->examTimetable->schoolClass->class_name ?? 'N/A' }}
                                        @else
                                            {{ $mark->class_name ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($mark->examTimetable && $mark->examTimetable->section)
                                            {{ $mark->examTimetable->section->section_name ?? 'N/A' }}
                                        @else
                                            {{ $mark->section_name ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($mark->subject)
                                            {{ $mark->subject->subject_name ?? 'N/A' }}
                                        @else
                                            {{ $mark->subject_name ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($mark->examTimetable && $mark->examTimetable->examType)
                                            {{ $mark->examTimetable->examType->name ?? 'N/A' }}
                                        @else
                                            {{ $mark->exam_type ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>{{ $mark->total_marks ?? 0 }}</td>
                                    <td>
                                        <strong class="text-primary">{{ $mark->obtained_marks ?? 0 }}</strong>
                                    </td>
                                    <td>
                                        @php
                                            $percentage = ($mark->total_marks > 0 && $mark->obtained_marks !== null) 
                                                ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) 
                                                : 0;
                                        @endphp
                                        @if($mark->obtained_marks !== null)
                                            <span class="badge bg-info">{{ $percentage }}%</span>
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($mark->obtained_marks !== null)
                                            @if($percentage >= 40)
                                                <span class="badge bg-success">Pass</span>
                                            @else
                                                <span class="badge bg-danger">Fail</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('teacher.marks.show', $mark->exam_timetable_id) }}" 
                                               class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('teacher.marks.edit', $mark->id) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('teacher.marks.destroy', $mark->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" 
                                                        onclick="return confirm('Delete this mark?')"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $marks->links() }}
                </div>

            @else

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No marks found. 
                    <a href="{{ route('teacher.marks.index') }}" class="alert-link">Go to timetables</a>
                </div>

            @endif

        </div>
    </div>

</div>

@endsection