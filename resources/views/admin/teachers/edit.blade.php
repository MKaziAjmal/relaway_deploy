@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h3>Edit Teacher</h3>

        </div>

        <div class="card-body">

            <form action="{{ route('teachers.update',$teacher->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$teacher->user->name) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$teacher->user->email) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Employee ID</label>

                    <input
                        type="text"
                        name="employee_id"
                        class="form-control"
                        value="{{ old('employee_id',$teacher->employee_id) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Specialization</label>

                    <input
                        type="text"
                        name="specialization"
                        class="form-control"
                        value="{{ old('specialization',$teacher->specialization) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone',$teacher->phone) }}"
                        required>

                </div>

                <button class="btn btn-success">

                    Update Teacher

                </button>

                <a href="{{ route('teachers.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection