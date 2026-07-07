@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Grade Distribution</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row">
        @php
            $grades = [
                'A+' => ['color' => 'success', 'range' => '90-100%'],
                'A' => ['color' => 'primary', 'range' => '80-89%'],
                'B' => ['color' => 'info', 'range' => '70-79%'],
                'C' => ['color' => 'warning', 'range' => '60-69%'],
                'D' => ['color' => 'secondary', 'range' => '50-59%'],
                'F' => ['color' => 'danger', 'range' => 'Below 50%']
            ];
        @endphp

        @foreach($grades as $grade => $info)
        <div class="col-md-2">
            <div class="card bg-{{ $info['color'] }} text-white">
                <div class="card-body text-center">
                    <h3>{{ $grade }}</h3>
                    <h5>{{ $distribution[$grade] ?? 0 }}</h5>
                    <small>{{ $info['range'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5>Grade Distribution Details</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Grade</th>
                        <th>Range</th>
                        <th>Students</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = array_sum($distribution);
                    @endphp
                    @foreach($grades as $grade => $info)
                    <tr>
                        <td><span class="badge bg-{{ $info['color'] }}">{{ $grade }}</span></td>
                        <td>{{ $info['range'] }}</td>
                        <td>{{ $distribution[$grade] ?? 0 }}</td>
                        <td>{{ $total > 0 ? round(($distribution[$grade] ?? 0) / $total * 100, 2) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection