@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Edit School Class</h3>
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

            <form action="{{ route('classes.update', $class->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Class Name</label>

                    <input
                        type="text"
                        name="class_name"
                        class="form-control"
                        value="{{ old('class_name', $class->class_name) }}">

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4">{{ old('description', $class->description) }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Update Class

                </button>

                <a href="{{ route('classes.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection