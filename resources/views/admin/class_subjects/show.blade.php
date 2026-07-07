@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">
            <h3>Class Subject Details</h3>
        </div>

        <div class="card-body">

            <p><strong>Class:</strong> {{ $classSubject->schoolClass->class_name }}</p>

            <p><strong>Subject:</strong> {{ $classSubject->subject->name }}</p>

            <a href="{{ route('class-subjects.index') }}"
               class="btn btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

@endsection