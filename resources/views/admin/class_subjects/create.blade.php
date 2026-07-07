@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h3>Assign Subject to Class</h3>
        </div>

        <div class="card-body">

            {{-- Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('class-subjects.store') }}"
                  method="POST">

                @csrf

                {{-- Class --}}
                <div class="mb-3">

                    <label class="form-label">Class</label>

                    <select name="school_class_id" class="form-select" required>

                        <option value="">Select Class</option>

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}">
                                {{ $class->class_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Subject --}}
                <div class="mb-3">

                    <label class="form-label">Subject</label>

                    <select name="subject_id" class="form-select" required>

                        <option value="">Select Subject</option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}">
                                {{ $subject->subject_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <button class="btn btn-success">
                    Save Assignment
                </button>

                <a href="{{ route('class-subjects.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection