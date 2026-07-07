@extends('layouts.admin')

@section('content')

<div class="container-fluid">

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

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Class Section Assignments</h2>

        <a href="{{ route('class-sections.create') }}"
           class="btn btn-primary">
            Assign Section
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            @if($classSections->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    @foreach($classSections as $assignment)

                        <tr>

                            <td>{{ $classSections->firstItem() + $loop->index }}</td>

                            <td>{{ $assignment->schoolClass->class_name }}</td>

                            <td>{{ $assignment->section->section_name }}</td>

                            <td>

                                <a href="{{ route('class-sections.show',$assignment) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('class-sections.edit',$assignment) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('class-sections.destroy',$assignment) }}"
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

                    @endforeach

                    </tbody>

                </table>

            </div>

            {{ $classSections->links() }}

            @else

                <div class="alert alert-info">

                    No Class Section assignments found.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection