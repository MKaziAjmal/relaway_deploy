@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Performance Trends</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if(isset($trendsData) && count($trendsData) > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Academic Year</th>
                            <th>Average Score</th>
                            <th>Total Students</th>
                            <th>Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trendsData as $index => $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['year']->name }}</td>
                            <td>{{ $data['average'] }}%</td>
                            <td>{{ $data['student_count'] }}</td>
                            <td>
                                @if($index > 0)
                                    @php
                                        $prevAvg = $trendsData[$index - 1]['average'];
                                        $diff = $data['average'] - $prevAvg;
                                    @endphp
                                    @if($diff > 0)
                                        <span class="badge bg-success">↑ +{{ round($diff, 2) }}%</span>
                                    @elseif($diff < 0)
                                        <span class="badge bg-danger">↓ {{ round($diff, 2) }}%</span>
                                    @else
                                        <span class="badge bg-secondary">→ No change</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Base</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">No trend data available.</div>
            @endif
        </div>
    </div>
</div>
@endsection