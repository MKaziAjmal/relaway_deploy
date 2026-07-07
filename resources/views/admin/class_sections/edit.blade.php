@extends('layouts.admin')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">

<h3>Edit Assignment</h3>

</div>

<div class="card-body">

<form action="{{ route('class-sections.update',$classSection) }}"
method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label class="form-label">

Class

</label>

<select name="school_class_id"
class="form-select">

@foreach($classes as $class)

<option value="{{ $class->id }}"
{{ $classSection->school_class_id==$class->id?'selected':'' }}>

{{ $class->class_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">

Section

</label>

<select name="section_id"
class="form-select">

@foreach($sections as $section)

<option value="{{ $section->id }}"
{{ $classSection->section_id==$section->id?'selected':'' }}>

{{ $section->section_name }}

</option>

@endforeach

</select>

</div>

<button class="btn btn-primary">

Update

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