@extends('layouts.admin')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow border-0">

        <!-- Header -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                👨‍🏫 Teacher Management
            </h3>

            <a href="{{ route('teachers.create') }}" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Add Teacher
            </a>

        </div>

        <div class="card-body">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            @endif

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>
                        <th>Employee ID</th>
                        <th>Teacher Name</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Phone</th>
                        <th class="text-center">Actions</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($teachers as $teacher)

                        <tr>

                            <td>{{ $teacher->id }}</td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $teacher->employee_id }}
                                </span>
                            </td>

                            <td class="fw-bold">
                                {{ $teacher->user->name }}
                            </td>

                            <td>
                                {{ $teacher->user->email }}
                            </td>

                            <td>

                                <span class="badge bg-info text-dark">
                                    {{ $teacher->specialization }}
                                </span>

                            </td>

                            <td>
                                {{ $teacher->phone }}
                            </td>

                            <td class="text-center">

                                <a
                                    href="{{ route('teachers.show',$teacher->id) }}"
                                    class="btn btn-sm btn-info">

                                    👁 View

                                </a>

                                <a
                                    href="{{ route('teachers.edit',$teacher->id) }}"
                                    class="btn btn-sm btn-warning">

                                    ✏ Edit

                                </a>

                                <form
                                    action="{{ route('teachers.destroy',$teacher->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this teacher?')">

                                        🗑 Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="text-center py-5">

                                    <h4 class="text-muted">
                                        No Teachers Found
                                    </h4>

                                    <p class="text-secondary">
                                        Click the button below to add your first teacher.
                                    </p>

                                    <a href="{{ route('teachers.create') }}"
                                       class="btn btn-primary">

                                        Add Teacher

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer">

            {{ $teachers->links() }}

        </div>

    </div>

</div>

@endsection