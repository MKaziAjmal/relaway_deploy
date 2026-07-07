@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>School Classes</h2>

        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            Add Class
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            @if($classes->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>
                            <th>#</th>
                            <th>Class Name</th>
                            <th>Description</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($classes as $class)

                        <tr>

                            <td>{{ $classes->firstItem() + $loop->index }}</td>

                            <td>{{ $class->class_name }}</td>

                            <td>{{ $class->description ?? '-' }}</td>

                            <td>

                                <a href="{{ route('classes.show', $class->id) }}"
                                   class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="{{ route('classes.edit', $class->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('classes.destroy', $class->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this class?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{ $classes->links() }}

            @else

                <div class="alert alert-info">

                    No classes found.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection