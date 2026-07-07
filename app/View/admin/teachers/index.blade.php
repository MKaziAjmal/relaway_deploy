@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">

        <h2>Teachers</h2>

        <a href="{{ route('teachers.create') }}"
           class="btn btn-primary">
            Add Teacher
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered">

        <thead>

        <tr>

            <th>ID</th>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Phone</th>

        </tr>

        </thead>

        <tbody>

        @forelse($teachers as $teacher)

        <tr>

            <td>{{ $teacher->id }}</td>

            <td>{{ $teacher->employee_id }}</td>

            <td>{{ $teacher->user->name }}</td>

            <td>{{ $teacher->user->email }}</td>

            <td>{{ $teacher->department }}</td>

            <td>{{ $teacher->phone }}</td>

        </tr>

        @empty

        <tr>

            <td colspan="6">
                No Teachers Found
            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    {{ $teachers->links() }}

</div>

@endsection