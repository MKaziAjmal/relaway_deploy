@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2>Add Student</h2>

    <hr>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">

        @csrf

        <h4>User Information</h4>

        <div class="mb-3">
            <label>Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>
        </div>

        <div class="mb-4">
            <label>Confirm Password</label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>
        </div>

        <h4>Student Information</h4>

        <div class="mb-3">
            <label>Admission Number</label>

            <input
                type="text"
                name="admission_no"
                class="form-control"
                value="{{ old('admission_no') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Gender</label>

            <select
                name="gender"
                class="form-select"
                required>

                <option value="">Select Gender</option>

                <option value="Male">Male</option>

                <option value="Female">Female</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>

            <input
                type="date"
                name="date_of_birth"
                class="form-control"
                value="{{ old('date_of_birth') }}"
                required>
        </div>

        <div class="mb-3">
            <label>Phone</label>

            <input
                type="text"
                name="phone"
                class="form-control"
                value="{{ old('phone') }}"
                required>
        </div>

        <div class="mb-4">
            <label>Address</label>

            <textarea
                name="address"
                rows="3"
                class="form-control">{{ old('address') }}</textarea>
        </div>

        <button class="btn btn-primary">
            Save Student
        </button>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection