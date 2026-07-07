@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header">

            <h3>Edit Section</h3>

        </div>

        <div class="card-body">

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('sections.update', $section->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">

                        Section Name

                    </label>

                    <input type="text"
                           name="section_name"
                           class="form-control"
                           value="{{ old('section_name', $section->section_name) }}">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description"
                              class="form-control"
                              rows="4">{{ old('description', $section->description) }}</textarea>

                </div>

                <button class="btn btn-primary">

                    Update Section

                </button>

                <a href="{{ route('sections.index') }}"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection