@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h3>Academic Year Details</h3>

            <a href="{{ route('academic-years.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Academic Year</th>
                    <td>{{ $academicYear->name }}</td>
                </tr>

                <tr>
                    <th>Start Date</th>
                    <td>{{ $academicYear->start_date }}</td>
                </tr>

                <tr>
                    <th>End Date</th>
                    <td>{{ $academicYear->end_date }}</td>
                </tr>

                <tr>
                    <th>Current</th>
                    <td>

                        @if($academicYear->is_current)

                            <span class="badge bg-success">

                                Yes

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                No

                            </span>

                        @endif

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection