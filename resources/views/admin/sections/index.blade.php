@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Sections</h2>

        <a href="{{ route('sections.create') }}"
           class="btn btn-primary">

            Add Section

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card">

        <div class="card-body">

            @if($sections->count())

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Section</th>

                            <th>Description</th>

                            <th width="220">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($sections as $section)

                        <tr>

                            <td>{{ $sections->firstItem() + $loop->index }}</td>

                            <td>{{ $section->section_name }}</td>

                            <td>{{ $section->description ?? '-' }}</td>

                            <td>

                                <a href="{{ route('sections.show', $section) }}"
                                   class="btn btn-info btn-sm">

                                    View

                                </a>

                                <a href="{{ route('sections.edit', $section) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('sections.destroy', $section) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this section?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{ $sections->links() }}

            @else

                <div class="alert alert-info">

                    No sections found.

                </div>

            @endif

        </div>

    </div>

</div>

@endsection