@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Pass Rate Analysis</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Pass Rate</h3>
                    <div class="display-1 text-success">{{ $passRate ?? 'N/A' }}%</div>
                    <p>Students who passed all subjects</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Average Score</h3>
                    <div class="display-1 text-primary">{{ $averageScore ?? 'N/A' }}%</div>
                    <p>Overall average score</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection