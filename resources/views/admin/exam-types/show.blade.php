@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between">

            <h4 class="mb-0">
                Exam Type Details
            </h4>

            <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">
                Back
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Name</th>
                    <td>{{ $examType->name }}</td>
                </tr>

                <tr>
                    <th>Code</th>
                    <td>{{ $examType->code }}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $examType->description ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>

                    <td>

                        @if($examType->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </td>

                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $examType->created_at->format('d M Y h:i A') }}</td>
                </tr>

                <tr>
                    <th>Updated At</th>
                    <td>{{ $examType->updated_at->format('d M Y h:i A') }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection