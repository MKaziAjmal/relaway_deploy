@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Edit Academic Year</h3>
        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('academic-years.update',$academicYear->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Academic Year</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$academicYear->name) }}">

                </div>

                <div class="mb-3">

                    <label>Start Date</label>

                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        value="{{ old('start_date',$academicYear->start_date) }}">

                </div>

                <div class="mb-3">

                    <label>End Date</label>

                    <input
                        type="date"
                        name="end_date"
                        class="form-control"
                        value="{{ old('end_date',$academicYear->end_date) }}">

                </div>

                <div class="form-check mb-3">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="is_current"
                        value="1"
                        id="isCurrent"
                        {{ $academicYear->is_current ? 'checked' : '' }}>

                    <label class="form-check-label" for="isCurrent">

                        Set as Current Academic Year

                    </label>

                </div>

                <button class="btn btn-primary">

                    Update Academic Year

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