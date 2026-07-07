@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Exam Performance</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5>Subject</h5>
                    <h4>{{ $exam->subject->name ?? 'N/A' }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5>Pass Rate</h5>
                    <h4>{{ $passRate ?? 0 }}%</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5>Total Students</h5>
                    <h4>{{ $totalStudents ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(isset($performanceData) && count($performanceData) > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Marks Obtained</th>
                            <th>Total Marks</th>
                            <th>Percentage</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performanceData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['student']->name }}</td>
                            <td>{{ $data['marks_obtained'] }}</td>
                            <td>{{ $data['total_marks'] }}</td>
                            <td>{{ $data['percentage'] }}%</td>
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
                <div class="alert alert-info">No data available for this exam.</div>
            @endif
        </div>
    </div>
</div>
@endsection