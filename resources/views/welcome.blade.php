<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AcadEase Pro - Exam & Marks Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* Header / Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            margin-bottom: 40px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #f7971e, #ffd200);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #1a1a1a;
        }

        .brand-text {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-text span {
            color: #f7971e;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-links .btn-primary {
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: #1a1a1a;
            font-weight: 600;
        }

        .nav-links .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(247, 151, 30, 0.3);
            background: linear-gradient(135deg, #ffa825, #ffe033);
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 24px;
            padding: 50px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
        }

        .hero-section {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .badge {
            display: inline-block;
            background: rgba(247, 151, 30, 0.15);
            color: #f7971e;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            width: fit-content;
            border: 1px solid rgba(247, 151, 30, 0.2);
        }

        .hero-title {
            font-size: 48px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .hero-title span {
            background: linear-gradient(135deg, #f7971e, #ffd200);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.7;
            max-width: 500px;
        }

        .hero-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 8px;
        }

        .feature-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.04);
            padding: 8px 16px;
            border-radius: 50px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .feature-tag i {
            color: #f7971e;
            font-size: 12px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            padding: 14px 36px;
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: #1a1a1a;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(247, 151, 30, 0.35);
        }

        .btn-hero-secondary {
            padding: 14px 36px;
            background: rgba(255, 255, 255, 0.06);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
        }

        /* Hero Image / Illustration */
        .hero-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .hero-visual .illustration {
            width: 100%;
            max-width: 480px;
            background: linear-gradient(135deg, rgba(247, 151, 30, 0.08), rgba(255, 210, 0, 0.04));
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(247, 151, 30, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .illustration-icon {
            font-size: 80px;
            margin-bottom: 20px;
            display: block;
        }

        .illustration h3 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .illustration p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            line-height: 1.6;
        }

        .floating-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .floating-card {
            background: rgba(255, 255, 255, 0.04);
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            text-align: left;
        }

        .floating-card i {
            color: #f7971e;
            font-size: 18px;
            margin-bottom: 6px;
        }

        .floating-card h6 {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .floating-card p {
            color: rgba(255, 255, 255, 0.4);
            font-size: 12px;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding: 30px 40px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            text-align: center;
        }

        .footer-brand {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .footer-brand span {
            color: #f7971e;
        }

        .footer .university {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .footer .university i {
            color: #f7971e;
            margin: 0 6px;
        }

        .footer .supervisor {
            color: rgba(255, 255, 255, 0.4);
            font-size: 13px;
            margin-bottom: 12px;
        }

        .footer .supervisor strong {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
        }

        .footer .developers {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .footer .developer {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .footer .developer:hover {
            background: rgba(247, 151, 30, 0.1);
            color: #ffffff;
            border-color: rgba(247, 151, 30, 0.2);
        }

        .footer .developer i {
            color: #f7971e;
            margin-right: 6px;
            font-size: 12px;
        }

        .footer .copyright {
            color: rgba(255, 255, 255, 0.2);
            font-size: 12px;
            margin-top: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.04);
            padding-top: 14px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                grid-template-columns: 1fr;
                padding: 30px;
                gap: 30px;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-visual .illustration {
                max-width: 100%;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                gap: 16px;
                padding: 16px 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero-title {
                font-size: 28px;
            }

            .main-content {
                padding: 20px;
            }

            .floating-cards {
                grid-template-columns: 1fr;
            }

            .footer .developers {
                gap: 10px;
            }

            .footer .developer {
                font-size: 12px;
                padding: 4px 12px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <!-- Navbar -->
        <nav class="navbar">
            <a href="/" class="brand">
                <div class="brand-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span class="brand-text">Acad<span>Ease</span> Pro</span>
            </a>
            <div class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-th-large"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @endif -->
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">

            <!-- Hero Section -->
            <div class="hero-section">
                <div class="badge">
                    <i class="fas fa-rocket"></i> Next-Gen Education Platform
                </div>

                <h1 class="hero-title">
                    Exam & Marks<br>
                    <span>Management System</span>
                </h1>

                <p class="hero-subtitle">
                    Streamline your academic workflow with our comprehensive exam scheduling,
                    marks entry, and performance tracking platform.
                </p>

                <div class="hero-features">
                    <span class="feature-tag">
                        <i class="fas fa-check-circle"></i> Exam Scheduling
                    </span>
                    <span class="feature-tag">
                        <i class="fas fa-check-circle"></i> Marks Entry
                    </span>
                    <span class="feature-tag">
                        <i class="fas fa-check-circle"></i> Performance Cards
                    </span>
                    <span class="feature-tag">
                        <i class="fas fa-check-circle"></i> Transcripts/DMC
                    </span>
                </div>

                <div class="hero-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-hero-primary">
                            <i class="fas fa-th-large"></i> Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero-primary">
                            <i class="fas fa-sign-in-alt"></i> Get Started
                        </a>
                        <a href="{{ route('register') }}" class="btn-hero-secondary">
                            <i class="fas fa-user-plus"></i> Create Account
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="hero-visual">
                <div class="illustration">
                    <span class="illustration-icon">🎓</span>
                    <h3>Academic Excellence</h3>
                    <p>Modern solution for educational institutions</p>

                    <div class="floating-cards">
                        <div class="floating-card">
                            <i class="fas fa-calendar-check"></i>
                            <h6>Exam Scheduling</h6>
                            <p>Plan & manage exams</p>
                        </div>
                        <div class="floating-card">
                            <i class="fas fa-edit"></i>
                            <h6>Marks Entry</h6>
                            <p>Quick & accurate</p>
                        </div>
                        <div class="floating-card">
                            <i class="fas fa-id-card"></i>
                            <h6>Performance Cards</h6>
                            <p>Track progress</p>
                        </div>
                        <div class="floating-card">
                            <i class="fas fa-file-alt"></i>
                            <h6>Transcripts/DMC</h6>
                            <p>Official documents</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-brand">Acad<span>Ease</span> Pro</div>

            <div class="university">
                <i class="fas fa-university"></i>
                Department of Computer System Engineering
                <i class="fas fa-circle" style="font-size: 4px; vertical-align: middle;"></i>
                UET Peshawar
            </div>

            <div class="supervisor">
                <i class="fas fa-user-tie"></i>
                Supervised by: <strong>Engr. Sumayyia Sillahudin</strong>
            </div>

            <div class="developers">
                <span class="developer">
                    <i class="fas fa-code"></i> Muhammad Kazim Ahmad
                </span>
                <span class="developer">
                    <i class="fas fa-code"></i> Mubasir Anwer
                </span>
                <span class="developer">
                    <i class="fas fa-code"></i> Masaud Ahmad
                </span>
                <span class="developer">
                    <i class="fas fa-code"></i> Ahmad Shahzad
                </span>
            </div>

            <div class="copyright">
                &copy; {{ date('Y') }} AcadEase Pro — All Rights Reserved.
                <br>
                <span style="font-size: 11px; color: rgba(255,255,255,0.15);">
                    Developed with <i class="fas fa-heart" style="color: #f7971e;"></i> by CSE Department, UET Peshawar
                </span>
            </div>
        </footer>

    </div>

</body>
</html>