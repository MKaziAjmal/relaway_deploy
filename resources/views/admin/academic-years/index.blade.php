@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Academic Years</h2>
        
        <a href="{{ route('academic-years.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Academic Year
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            @if($academicYears->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicYears as $academicYear)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $academicYear->name }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($academicYear->start_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($academicYear->end_date)->format('d-m-Y') }}</td>
                                <td>
                                    @if($academicYear->is_current)
                                        <span class="badge bg-success">Current</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- View -->
                                    <a href="{{ route('academic-years.show', $academicYear->id) }}"
                                       class="btn btn-info btn-sm"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('academic-years.edit', $academicYear->id) }}"
                                       class="btn btn-warning btn-sm"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('academic-years.destroy', $academicYear->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this academic year?')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $academicYears->links() }}
                </div>

            @else
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                    <h5>No academic years found</h5>
                    <p class="mb-0">Click the "Add Academic Year" button to create one.</p>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection