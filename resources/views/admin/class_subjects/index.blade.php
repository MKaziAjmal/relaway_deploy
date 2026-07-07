@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Class Subjects</h3>

        <a href="{{ route('class-subjects.create') }}"
           class="btn btn-primary">
            + Assign Subject
        </a>

    </div>

    {{-- Messages --}}
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

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th width="180">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($classSubjects as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->schoolClass->class_name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $item->subject->subject_name ?? 'N/A' }}
                                </td>

                                <td class="d-flex gap-1">

                                    {{-- EDIT --}}
                                    <a href="{{ route('class-subjects.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('class-subjects.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this assignment?')">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No class-subject assignments found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection