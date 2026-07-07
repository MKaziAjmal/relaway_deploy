@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Exam Timetables</h3>

        <div>

            <a href="{{ route('exam-timetables.create') }}"
               class="btn btn-primary">
                Add Timetable
            </a>

            <a href="{{ route('exam-timetables.print', request('exam_id')) }}"
               class="btn btn-success"
               target="_blank">
                Print
            </a>

        </div>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Exam Type Filters --}}
    <div class="card mb-3">

        <div class="card-body">

            <a href="{{ route('exam-timetables.index') }}"
               class="btn {{ request('exam_id') ? 'btn-outline-dark' : 'btn-dark' }} mb-2">

                All

            </a>

            @foreach($examTypes as $exam)

                <a href="{{ route('exam-timetables.index',['exam_id'=>$exam->id]) }}"
                   class="btn {{ request('exam_id') == $exam->id ? 'btn-primary' : 'btn-outline-primary' }} mb-2">

                    {{ $exam->name }}

                </a>

            @endforeach

        </div>

    </div>


    {{-- Timetable Table --}}
    <div class="card shadow">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>ID</th>
                        <th>Exam</th>
                        <th>Academic Year</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Remarks</th>
                        <th width="150">Actions</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($examTimetables as $item)

                    <tr>

                        <td>{{ $item->id }}</td>

                        <td>{{ $item->examType->name ?? '-' }}</td>

                        <td>{{ $item->academicYear->name ?? '-' }}</td>

                        <td>{{ $item->schoolClass->class_name ?? '-' }}</td>

                        <td>{{ $item->section->section_name ?? '-' }}</td>

                        <td>{{ $item->subject->subject_name ?? '-' }}</td>

                        <td>{{ $item->exam_date }}</td>

                        <td>
                            {{ $item->start_time }}
                            <br>
                            to
                            <br>
                            {{ $item->end_time }}
                        </td>

                        <td>{{ $item->room }}</td>

                        <td>{{ $item->remarks }}</td>

                        <td>

                            <a href="{{ route('exam-timetables.edit',$item->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('exam-timetables.destroy',$item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this timetable?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="11" class="text-center">

                            No Exam Timetable Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="mt-3">

                {{ $examTimetables->links() }}

            </div>

        </div>

    </div>

</div>

@endsection