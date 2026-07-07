@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h3>Teacher Details</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>Employee ID</th>
                    <td>{{ $teacher->employee_id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $teacher->user->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $teacher->user->email }}</td>
                </tr>

                <tr>
                    <th>Specialization</th>
                    <td>{{ $teacher->specialization }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $teacher->phone }}</td>
                </tr>

            </table>

            <a href="{{ route('teachers.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

@endsection