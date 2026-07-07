@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Edit Student</h3>
        </div>

        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('students.update',$student->id) }}" method="POST">

                @csrf
                @method('PUT')

                <h5>User Information</h5>

                <div class="mb-3">

                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$student->user->name) }}">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$student->user->email) }}">

                </div>

                <hr>

                <h5>Student Information</h5>

                <div class="mb-3">

                    <label>Admission Number</label>

                    <input
                        type="text"
                        name="admission_no"
                        class="form-control"
                        value="{{ old('admission_no',$student->admission_no) }}">

                </div>

                <div class="mb-3">

                    <label>Gender</label>

                    <select
                        name="gender"
                        class="form-select">

                        <option value="Male"
                            {{ $student->gender=='Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ $student->gender=='Female' ? 'selected' : '' }}>
                            Female
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Date of Birth</label>

                    <input
                        type="date"
                        name="date_of_birth"
                        class="form-control"
                        value="{{ old('date_of_birth',$student->date_of_birth) }}">

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone',$student->phone) }}">

                </div>

                <div class="mb-3">

                    <label>Address</label>

                    <textarea
                        name="address"
                        class="form-control"
                        rows="4">{{ old('address',$student->address) }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Update Student

                </button>

                <a href="{{ route('students.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection