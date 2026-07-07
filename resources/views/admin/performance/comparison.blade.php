@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Performance Comparison</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-8">
                        <label>Select Classes to Compare</label>
                        <select name="classes[]" class="form-select" multiple>
                            @foreach($classes ?? [] as $class)
                                <option value="{{ $class->id }}" 
                                    {{ in_array($class->id, $selectedClasses ?? []) ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Compare</button>
                    </div>
                </div>
            </form>

            @if(isset($comparisonData) && count($comparisonData) > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Average Score</th>
                            <th>Total Students</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comparisonData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data['class']->class_name }}</td>
                            <td>{{ $data['average'] }}%</td>
                            <td>{{ $data['student_count'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">Select classes to compare performance.</div>
            @endif
        </div>
    </div>
</div>
@endsection