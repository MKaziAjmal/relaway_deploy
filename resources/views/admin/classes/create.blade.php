@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Add School Class</h3>
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

            <form action="{{ route('classes.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>Class Name</label>

                    <input
                        type="text"
                        name="class_name"
                        class="form-control"
                        value="{{ old('class_name') }}"
                        placeholder="Grade 1">

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4">{{ old('description') }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Save Class

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