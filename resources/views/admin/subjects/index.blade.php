@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Subject Management</h2>

        <a href="{{ route('subjects.create') }}" class="btn btn-primary">
            Add Subject
        </a>
    </div>

    <div class="card">

        <div class="card-body">

            @if($subjects->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Description</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($subjects as $subject)

                        <tr>

                            <td>{{ $subjects->firstItem() + $loop->index }}</td>

                            <td>{{ $subject->subject_code }}</td>

                            <td>{{ $subject->subject_name }}</td>

                            <td>{{ $subject->description ?? '-' }}</td>

                            <td>

                                <a href="{{ route('subjects.show',$subject->id) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('subjects.edit',$subject->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('subjects.destroy',$subject->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this subject?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{ $subjects->links() }}

            @else

            <div class="alert alert-info">

                No subjects found.

            </div>

            @endif

        </div>

    </div>

</div>

@endsection