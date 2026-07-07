@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">
                Edit Exam Type
            </h4>
        </div>

        <div class="card-body">

            <form action="{{ route('exam-types.update', $examType) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Exam Type Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $examType->name) }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        class="form-control @error('code') is-invalid @enderror"
                        value="{{ old('code', $examType->code) }}">

                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $examType->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror">

                        <option value="1" {{ old('status', $examType->status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status', $examType->status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <button class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('exam-types.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection