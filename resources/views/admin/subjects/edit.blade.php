@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <div class="card">

        <div class="card-header">
            <h3>Edit Subject</h3>
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

            <form action="{{ route('subjects.update',$subject->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Subject Code</label>

                    <input type="text"
                           name="subject_code"
                           class="form-control"
                           value="{{ old('subject_code',$subject->subject_code) }}">

                </div>

                <div class="mb-3">

                    <label>Subject Name</label>

                    <input type="text"
                           name="subject_name"
                           class="form-control"
                           value="{{ old('subject_name',$subject->subject_name) }}">

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4">{{ old('description',$subject->description) }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Update Subject

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