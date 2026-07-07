@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h3>Section Details</h3>

            <a href="{{ route('sections.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="30%">
                        Section Name
                    </th>

                    <td>

                        {{ $section->section_name }}

                    </td>

                </tr>

                <tr>

                    <th>
                        Description
                    </th>

                    <td>

                        {{ $section->description ?? '-' }}

                    </td>

                </tr>

            </table>

        </div>

    </div>

</div>

@endsection