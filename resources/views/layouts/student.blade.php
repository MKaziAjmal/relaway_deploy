<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Student Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        .card {
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .bg-gradient-primary {
            background: linear-gradient(45deg, #007bff, #0056b3);
        }
        .table th {
            white-space: nowrap;
        }
        .nav-link.active {
            font-weight: bold;
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
        .navbar-brand i {
            margin-right: 8px;
        }
        .dropdown-item i {
            width: 20px;
            margin-right: 8px;
        }
        .logout-btn {
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 8px 20px;
            color: #212529;
            font-size: 16px;
        }
        .logout-btn:hover {
            background-color: #f8f9fa;
            color: #dc3545;
        }
        .logout-btn i {
            color: #dc3545;
            margin-right: 8px;
        }
        .logout-form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('student.dashboard') }}">
                <i class="fas fa-user-graduate"></i> Student Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" 
                           href="{{ route('student.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.marks.*') ? 'active' : '' }}" 
                           href="{{ route('student.marks.index') }}">
                            <i class="fas fa-file-alt"></i> Marks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.performance-card*') ? 'active' : '' }}" 
                           href="{{ route('student.performance-card') }}">
                            <i class="fas fa-id-card"></i> Performance Card
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-circle"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.marks.index') }}">
                                    <i class="fas fa-file-alt"></i> My Marks
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.performance-card') }}">
                                    <i class="fas fa-id-card"></i> Performance Card
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <!-- LOGOUT FORM - WORKING -->
                                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Confirm logout
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForms = document.querySelectorAll('.logout-form');
            logoutForms.forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to logout?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>