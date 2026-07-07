@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Teacher Subject Assignments</h3>

        <a href="{{ route('teacher-subjects.create') }}"
           class="btn btn-primary">
            + Assign Teacher
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

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Academic Year</th>
                        <th width="220">Actions</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($assignments as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->teacher->user->name }}</td>

                        <td>{{ $item->schoolClass->class_name }}</td>

                        <td>{{ $item->section->section_name }}</td>

                        <td>{{ $item->subject->subject_name }}</td>

                        <td>{{ $item->academicYear->name }}</td>

                        <td>

                            <a href="{{ route('teacher-subjects.show', $item) }}"
                               class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('teacher-subjects.edit', $item) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('teacher-subjects.destroy', $item) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this assignment?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">
                            No assignments found.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection