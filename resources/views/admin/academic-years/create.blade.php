@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Add Academic Year</h3>
        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('academic-years.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Academic Year</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="2025-2026"
                        value="{{ old('name') }}">

                </div>

                <div class="mb-3">

                    <label>Start Date</label>

                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        value="{{ old('start_date') }}">

                </div>

                <div class="mb-3">

                    <label>End Date</label>

                    <input
                        type="date"
                        name="end_date"
                        class="form-control"
                        value="{{ old('end_date') }}">

                </div>

                <div class="form-check mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_current"
                        value="1"
                        id="isCurrent">

                    <label class="form-check-label" for="isCurrent">

                        Set as Current Academic Year

                    </label>

                </div>

                <button class="btn btn-primary">

                    Save Academic Year

                </button>

                <a href="{{ route('academic-years.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection