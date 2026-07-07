@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Students Management</h2>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            @if($students->count())

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Admission No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Date of Birth</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($students as $student)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $student->admission_no }}</td>

                                    <td>{{ $student->user->name }}</td>

                                    <td>{{ $student->user->email }}</td>

                                    <td>{{ $student->gender }}</td>

                                    <td>{{ $student->phone }}</td>

                                    <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') }}</td>

                                    <td>

                                        <a href="{{ route('students.show', $student->id) }}"
                                           class="btn btn-info btn-sm">
                                            View
                                        </a>

                                        <a href="{{ route('students.edit', $student->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('students.destroy', $student->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this student?')">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $students->links() }}
                </div>

            @else

                <div class="alert alert-info">
                    No students found.
                </div>

            @endif

        </div>
    </div>

</div>

@endsection