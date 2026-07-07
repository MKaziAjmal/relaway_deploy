@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header">
            <h3>Edit Class Subject</h3>
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

            <form action="{{ route('class-subjects.update', $classSubject->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- Class --}}
                <div class="mb-3">

                    <label>Class</label>

                    <select name="school_class_id" class="form-select">

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ $classSubject->school_class_id == $class->id ? 'selected' : '' }}>

                                {{ $class->class_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Subject --}}
                <div class="mb-3">

                    <label>Subject</label>

                    <select name="subject_id" class="form-select">

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ $classSubject->subject_id == $subject->id ? 'selected' : '' }}>

                                {{ $subject->subject_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <button class="btn btn-primary">
                    Update
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