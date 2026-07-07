@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Admin Dashboard
    </h2>

    <p class="text-muted">
        Welcome,
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    <div class="row mt-4">

        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Teachers</h5>
                    <h2>{{ $teachers }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h2>{{ $students }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5>Total Subjects</h5>
                    <h2>{{ $subjects }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5>Total Timetables</h5>
                    <h2>{{ $timetables }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection