@extends('layouts.admin')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">

<h3>Assign Section to Class</h3>

</div>

<div class="card-body">

<form action="{{ route('class-sections.store') }}" method="POST">

@csrf

<div class="mb-3">

<label class="form-label">Class</label>

<select name="school_class_id" class="form-select">

<option value="">Select Class</option>

@foreach($classes as $class)

<option value="{{ $class->id }}">

{{ $class->class_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">Section</label>

<select name="section_id" class="form-select">

<option value="">Select Section</option>

@foreach($sections as $section)

<option value="{{ $section->id }}">

{{ $section->section_name }}

</option>

@endforeach

</select>

</div>

<button class="btn btn-primary">

Save Assignment

</button>

<a href="{{ route('class-sections.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

@endsection