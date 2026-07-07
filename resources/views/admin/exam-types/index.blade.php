@extends('layouts.admin')

@section('content')

<div class="container">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Exam Types</h2>

        <a href="{{ route('exam-types.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Exam Type
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    {{-- Search Card --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <form method="GET" action="{{ route('exam-types.index') }}">

                <div class="row">

                    <div class="col-md-4">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search by Name or Code"
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('exam-types.index') }}"
                           class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Table Card --}}
    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th width="60">#</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th width="220">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($examTypes as $examType)

                            <tr>

                                <td>
                                    {{ $loop->iteration + ($examTypes->firstItem() - 1) }}
                                </td>

                                <td>{{ $examType->name }}</td>

                                <td>{{ $examType->code }}</td>

                                <td>
                                    {{ $examType->description ?? '-' }}
                                </td>

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

                                <td>

                                    <a href="{{ route('exam-types.show', $examType) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('exam-types.edit', $examType) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('exam-types.destroy', $examType) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Exam Type?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted">
                                    No Exam Types Found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $examTypes->links() }}
            </div>

        </div>

    </div>

</div>

@endsection