@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h3>Subject Details</h3>

            <a href="{{ route('subjects.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Subject Code</th>
                    <td>{{ $subject->subject_code }}</td>
                </tr>

                <tr>
                    <th>Subject Name</th>
                    <td>{{ $subject->subject_name }}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $subject->description }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection