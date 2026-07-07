@extends('layouts.admin')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">

<h3>Assignment Details</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="30%">

Class

</th>

<td>

{{ $classSection->schoolClass->class_name }}

</td>

</tr>

<tr>

<th>

Section

</th>

<td>

{{ $classSection->section->section_name }}

</td>

</tr>

</table>

<a href="{{ route('class-sections.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

@endsection