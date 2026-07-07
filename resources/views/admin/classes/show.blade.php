@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h3>Class Details</h3>

            <a href="{{ route('classes.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="25%">Class Name</th>

                    <td>{{ $class->class_name }}</td>

                </tr>

                <tr>

                    <th>Description</th>

                    <td>{{ $class->description }}</td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection