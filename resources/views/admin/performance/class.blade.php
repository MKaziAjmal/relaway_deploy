@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Class Performance: {{ $class->class_name ?? 'N/A' }}</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(isset($performanceData) && count($performanceData) > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Average Score</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performanceData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['student']->name }}</td>
                            <td>{{ $data['average'] }}%</td>
                            <td>
                                <span class="badge {{ $data['status'] == 'Pass' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No data available for this class.</div>
            @endif
        </div>
    </div>
</div>
@endsection

