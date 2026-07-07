@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Student Details</h3>

            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Admission No</th>
                    <td>{{ $student->admission_no }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $student->user->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $student->user->email }}</td>
                </tr>

                <tr>
                    <th>Gender</th>
                    <td>{{ $student->gender }}</td>
                </tr>

                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $student->date_of_birth }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $student->phone }}</td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td>{{ $student->address }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection