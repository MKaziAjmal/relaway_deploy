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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

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
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('teachers.index') }}">
                        Teachers
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('students.index') }}">
                        Students
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('subjects.index') }}">
                        Subjects
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('academic-years.index') }}">
                        Academic Years
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav">

                <li class="nav-item me-3">

                    <span class="navbar-text">

                        <i class="bi bi-person-circle"></i>

                        {{ auth()->user()->name }}

                    </span>

                </li>

                <li class="nav-item">

                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button class="btn btn-outline-light btn-sm">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

<div class="container-fluid mt-4">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>