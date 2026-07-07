<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Exam Management System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

        <div class="container-fluid">

            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                School Exam Management
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teachers.index') }}">
                            <i class="bi bi-person-workspace"></i>
                            Teachers
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('students.index') }}">
                            <i class="bi bi-mortarboard"></i>
                            Students
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('subjects.index') }}">
                            <i class="bi bi-book"></i>
                            Subjects
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('academic-years.index') }}">
                            <i class="bi bi-calendar-event"></i>
                            Academic Years
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('classes.index') }}">
                            <i class="bi bi-building"></i>
                            Classes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <i class="bi bi-grid-3x3-gap"></i>
                            Sections
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <i class="bi bi-calendar-week"></i>
                            Timetables
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <i class="bi bi-clipboard-data"></i>
                            Results
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav align-items-center">

                    <li class="nav-item me-3">

                        <span class="navbar-text text-white">

                            <i class="bi bi-person-circle"></i>

                            {{ auth()->user()->name }}

                        </span>

                    </li>

                    <li class="nav-item">

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button class="btn btn-outline-light btn-sm">

                                <i class="bi bi-box-arrow-right"></i>

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- Main Content -->

    <div class="container-fluid mt-4">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>