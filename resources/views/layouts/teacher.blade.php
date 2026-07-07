<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Teacher Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-dark bg-primary">

    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('teacher.dashboard') }}">
            Teacher Panel
        </a>

        <div>

            <span class="text-white me-3">
                {{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf

                <button class="btn btn-light btn-sm">
                    Logout
                </button>
            </form>

        </div>

    </div>

</nav>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 bg-light border-end min-vh-100">

            <div class="list-group list-group-flush mt-3">

                <a href="{{ route('teacher.dashboard') }}"
                   class="list-group-item list-group-item-action">
                    Dashboard
                </a>

                <a href="{{ route('teacher.marks.index') }}"
                   class="list-group-item list-group-item-action">
                    Marks
                </a>

            </div>

        </div>

        <div class="col-md-10 p-4">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>