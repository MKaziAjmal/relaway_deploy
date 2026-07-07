@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Student Enrollments</h2>

        <a href="{{ route('student-enrollments.create') }}"
           class="btn btn-primary">
            Enroll Student
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>
                        <th>Student</th>
                        <th>Admission No</th>
                        <th>Academic Year</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll No</th>
                        <th>Status</th>
                        <th width="220">Actions</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($enrollments as $enrollment)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $enrollment->student->user->name }}</td>

                            <td>{{ $enrollment->student->admission_no }}</td>

                            <td>{{ $enrollment->academicYear->name }}</td>

                            <td>{{ $enrollment->classSection->schoolClass->class_name }}</td>

                            <td>{{ $enrollment->classSection->section->section_name }}</td>

                            <td>{{ $enrollment->roll_no }}</td>

                            <td>

                                <span class="badge bg-success">

                                    {{ $enrollment->status }}

                                </span>

                            </td>

                            <td>

                                <a href="{{ route('student-enrollments.show',$enrollment) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('student-enrollments.edit',$enrollment) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('student-enrollments.destroy',$enrollment) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete Enrollment?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center">

                                No enrollments found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            {{ $enrollments->links() }}

        </div>

    </div>

</div>

@endsection