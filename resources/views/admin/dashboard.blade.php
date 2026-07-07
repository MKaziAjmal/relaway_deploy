@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Admin Dashboard</h2>
            <p class="text-muted mb-0">
                Welcome,
                <strong>{{ auth()->user()->name }}</strong>
            </p>
        </div>

    </div>

    <!-- Statistics Cards -->
    <div class="row g-4">

        <!-- Teachers -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary text-white shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-workspace fs-1"></i>
                    <h5 class="mt-3">Teachers</h5>
                    <h2>{{ $teachers }}</h2>
                    <a href="{{ route('teachers.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Students -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success text-white shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-mortarboard fs-1"></i>
                    <h5 class="mt-3">Students</h5>
                    <h2>{{ $students }}</h2>
                    <a href="{{ route('students.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Subjects -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-book fs-1"></i>
                    <h5 class="mt-3">Subjects</h5>
                    <h2>{{ $subjects }}</h2>
                    <a href="{{ route('subjects.index') }}" class="btn btn-dark btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Academic Years -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info text-white shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-event fs-1"></i>
                    <h5 class="mt-3">Academic Years</h5>
                    <h2>{{ $academicYears }}</h2>
                    <a href="{{ route('academic-years.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Classes -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-secondary text-white shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-building fs-1"></i>
                    <h5 class="mt-3">Classes</h5>
                    <h2>{{ $classes }}</h2>
                    <a href="{{ route('classes.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Sections -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-dark text-white shadow h-100">
                <div class="card-body text-center">
                    <i class="bi bi-grid-3x3-gap fs-1"></i>
                    <h5 class="mt-3">Sections</h5>
                    <h2>{{ $sections }}</h2>
                    <a href="{{ route('sections.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>
        <!-- Teacher Subject Assignments -->
<div class="col-lg-3 col-md-6">
    <div class="card text-white shadow h-100"
         style="background:#fd7e14;">

        <div class="card-body text-center">

            <i class="bi bi-person-lines-fill fs-1"></i>

            <h5 class="mt-3">Teacher Subjects</h5>

            <h2>{{ $teacherSubjects }}</h2>

            <a href="{{ route('teacher-subjects.index') }}"
               class="btn btn-light btn-sm mt-2">
                Manage
            </a>

        </div>

    </div>
</div>

        <!-- Class Sections -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow h-100" style="background:#6f42c1;">
                <div class="card-body text-center">
                    <i class="bi bi-diagram-3 fs-1"></i>
                    <h5 class="mt-3">Class Sections</h5>
                    <h2>{{ $classSections }}</h2>
                    <a href="{{ route('class-sections.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- ⭐ CLASS SUBJECTS (ADDED ONLY THIS) -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow h-100" style="background:#dc3545;">
                <div class="card-body text-center">
                    <i class="bi bi-journal-bookmark fs-1"></i>
                    <h5 class="mt-3">Class Subjects</h5>
                    <h2>{{ $classSubjects }}</h2>
                    <a href="{{ route('class-subjects.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Student Enrollments -->
        <div class="col-lg-3 col-md-6">
            <div class="card text-white shadow h-100" style="background:#198754;">
                <div class="card-body text-center">
                    <i class="bi bi-person-check-fill fs-1"></i>
                    <h5 class="mt-3">Enrollments</h5>
                    <h2>{{ $enrollments }}</h2>
                    <a href="{{ route('student-enrollments.index') }}" class="btn btn-light btn-sm mt-2">
                        Manage
                    </a>
                </div>
            </div>
        </div>

        <!-- Timetables -->
    <!-- Timetables -->
    <!-- Timetables -->
<div class="col-lg-3 col-md-6">
    <div class="card bg-danger text-white shadow h-100">
        <div class="card-body text-center">
            <i class="bi bi-calendar-week fs-1"></i>
            <h5 class="mt-3">Timetables</h5>
            <h2>{{ $examTimetables }}</h2>
         <a href="{{ route('exam-timetables.index') }}" class="btn btn-light btn-sm mt-2">
    Manage
</a>
        </div>
    </div>
</div>
    <!-- Exam Types -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white shadow h-100" style="background:#0d6efd;">
            <div class="card-body text-center">
                <i class="bi bi-file-earmark-text-fill fs-1"></i>
                <h5 class="mt-3">Exam Types</h5>
                <h2>{{ $examTypes }}</h2>
                <a href="{{ route('exam-types.index') }}" class="btn btn-light btn-sm mt-2">
                    Manage
                </a>
            </div>
        </div>
    </div>

</div>

    <!-- Quick Actions -->
    <div class="card shadow mt-5">

        <div class="card-header">
            <h4 class="mb-0">Quick Actions</h4>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-person-workspace"></i>
                        Teachers
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('students.index') }}" class="btn btn-success w-100">
                        <i class="bi bi-mortarboard"></i>
                        Students
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('subjects.index') }}" class="btn btn-warning w-100">
                        <i class="bi bi-book"></i>
                        Subjects
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('academic-years.index') }}" class="btn btn-info text-white w-100">
                        <i class="bi bi-calendar-event"></i>
                        Academic Years
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-building"></i>
                        Classes
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('sections.index') }}" class="btn btn-dark w-100">
                        <i class="bi bi-grid-3x3-gap"></i>
                        Sections
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('class-sections.index') }}"
                       class="btn text-white w-100"
                       style="background:#6f42c1;">
                        <i class="bi bi-diagram-3"></i>
                        Class Sections
                    </a>
                </div>

                <!-- Added Quick Action -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('class-subjects.index') }}"
                       class="btn btn-danger w-100">
                        <i class="bi bi-journal-bookmark"></i>
                        Class Subjects
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="{{ route('student-enrollments.index') }}"
                       class="btn btn-success w-100">
                        <i class="bi bi-person-check-fill"></i>
                        Enrollments
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
    <a href="{{ route('exam-types.index') }}"
       class="btn btn-primary w-100">

        <i class="bi bi-file-earmark-text-fill"></i>

        Exam Types

    </a>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
    <a href="{{ route('exam-timetables.index') }}"
       class="btn btn-success w-100">

        <i class="bi bi-calendar-week"></i>

        Exam Timetables

    </a>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
    <button class="btn btn-warning text-dark w-100" disabled>

        <i class="bi bi-file-earmark-check-fill"></i>

        Exams

    </button>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
    <button class="btn btn-danger w-100" disabled>

        <i class="bi bi-pencil-square"></i>

        Marks Entry

    </button>
</div>

<div class="col-lg-3 col-md-4 col-sm-6">
    <button class="btn btn-info text-white w-100" disabled>

        <i class="bi bi-award-fill"></i>

        Results

    </button>
</div>

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <button class="btn btn-danger w-100" disabled>
                        <i class="bi bi-calendar-week"></i>
                        Timetables
                    </button>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection