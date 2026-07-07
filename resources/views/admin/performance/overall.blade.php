@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Overall Performance</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5>Average Score</h5>
                    <h2>{{ $averageScore ?? 'N/A' }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5>Pass Rate</h5>
                    <h2>{{ $passRate ?? 'N/A' }}%</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h5>Top Performers</h5>
                    <h2>{{ $topPerformersCount ?? 'N/A' }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5>Total Students</h5>
                    <h2>{{ $totalStudents ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5>Performance Summary</h5>
            <p>Overall Performance: <strong>{{ $overallPerformance ?? 'N/A' }}</strong></p>
            <p>Highest Score: <strong>{{ $highestScore ?? 'N/A' }}%</strong></p>
            <p>Lowest Score: <strong>{{ $lowestScore ?? 'N/A' }}%</strong></p>
        </div>
    </div>
</div>
@endsection