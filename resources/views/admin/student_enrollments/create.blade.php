@extends('layouts.admin')

@section('content')

<div class="container">

<div class="card shadow">

<div class="card-header">

<h3>Enroll Student</h3>

</div>

<div class="card-body">

<form action="{{ route('student-enrollments.store') }}"
method="POST">

@csrf

<div class="mb-3">

<label class="form-label">

Student

</label>

<select name="student_id"
class="form-select">

<option value="">

Select Student

</option>

@foreach($students as $student)

<option value="{{ $student->id }}">

{{ $student->user->name }}
(
{{ $student->admission_no }}
)

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">

Academic Year

</label>

<select name="academic_year_id"
class="form-select">

<option value="">

Select Academic Year

</option>

@foreach($academicYears as $year)
    <option value="{{ $year->id }}">
        {{ $year->name }}
    </option>
@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">

Class Section

</label>

<select name="class_section_id"
class="form-select">

<option value="">

Select Class

</option>

@foreach($classSections as $item)

<option value="{{ $item->id }}">

{{ $item->schoolClass->class_name }}

-

{{ $item->section->section_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">

Roll No

</label>

<input type="text"
name="roll_no"
class="form-control">

</div>

<div class="mb-3">

<label class="form-label">

Status

</label>

<select name="status"
class="form-select">

<option>Active</option>

<option>Promoted</option>

<option>Graduated</option>

<option>Transferred</option>

<option>Left</option>

</select>

</div>

<button class="btn btn-primary">

Save

</button>

<a href="{{ route('student-enrollments.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

@endsection