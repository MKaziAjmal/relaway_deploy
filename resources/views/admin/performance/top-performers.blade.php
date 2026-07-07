@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Top Performers</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(isset($topStudents) && count($topStudents) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Average Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topStudents as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['student']->name }}</td>
                                <td>{{ $data['student']->schoolClass->class_name ?? 'N/A' }}</td>
                                <td>{{ $data['average'] }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">No data available.</div>
            @endif
        </div>
    </div>
</div>
@endsection