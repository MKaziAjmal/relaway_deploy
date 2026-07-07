@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Add Subject</h3>
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

            <form action="{{ route('subjects.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Subject Code</label>

                    <input type="text"
                           name="subject_code"
                           class="form-control"
                           value="{{ old('subject_code') }}"
                           required>

                </div>

                <div class="mb-3">

                    <label>Subject Name</label>

                    <input type="text"
                           name="subject_name"
                           class="form-control"
                           value="{{ old('subject_name') }}"
                           required>

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ old('description') }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Save Subject

                </button>

                <a href="{{ route('subjects.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection