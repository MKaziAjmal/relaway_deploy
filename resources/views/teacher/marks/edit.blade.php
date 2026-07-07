@extends('layouts.teacher')

@section('title', 'Edit Marks')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-edit"></i> Edit Student Marks</h3>
        <div>
            <a href="{{ route('teacher.marks.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Timetables
            </a>
            <a href="{{ route('teacher.marks.show', $mark->exam_timetable_id) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> View Marks
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-graduate"></i> Edit Student Marks</h4>
        </div>

        <div class="card-body">

            <!-- Student Details Summary -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <strong>Student:</strong>
                    <p>{{ $mark->student->user->name ?? $mark->student->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Roll No:</strong>
                    <p>{{ $mark->student->roll_no ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Class:</strong>
                    <p>{{ $mark->examTimetable->schoolClass->class_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Section:</strong>
                    <p>{{ $mark->examTimetable->section->section_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Subject:</strong>
                    <p>{{ $mark->subject->subject_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Exam:</strong>
                    <p>{{ $mark->examTimetable->examType->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Exam Date:</strong>
                    <p>{{ isset($mark->examTimetable->exam_date) ? \Carbon\Carbon::parse($mark->examTimetable->exam_date)->format('d-m-Y') : 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Current Marks:</strong>
                    <p>
                        <span class="badge bg-info">{{ $mark->obtained_marks ?? 0 }}</span>
                        <span class="text-muted">/ {{ $mark->total_marks ?? 0 }}</span>
                    </p>
                </div>
            </div>

            <form action="{{ route('teacher.marks.update', $mark->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- Exam --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Exam <span class="text-danger">*</span></label>
                        <select name="exam_id" class="form-select @error('exam_id') is-invalid @enderror" required>
                            <option value="">Select Exam</option>
                            @foreach($examTypes as $exam)
                                <option value="{{ $exam->id }}"
                                    {{ old('exam_id', $mark->examTimetable->exam_id) == $exam->id ? 'selected' : '' }}>
                                    {{ $exam->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Subject --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $mark->subject_id) == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Total Marks --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total Marks <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="total_marks" 
                               value="{{ old('total_marks', $mark->total_marks) }}" 
                               class="form-control @error('total_marks') is-invalid @enderror"
                               min="1"
                               required>
                        @error('total_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Obtained Marks --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Obtained Marks <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="obtained_marks" 
                               value="{{ old('obtained_marks', $mark->obtained_marks) }}" 
                               class="form-control @error('obtained_marks') is-invalid @enderror"
                               min="0"
                               max="{{ $mark->total_marks }}"
                               required>
                        @error('obtained_marks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maximum: {{ $mark->total_marks }}</small>
                    </div>

                    {{-- Remarks --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" 
                                  class="form-control @error('remarks') is-invalid @enderror" 
                                  rows="3">{{ old('remarks', $mark->remarks) }}</textarea>
                        @error('remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grade Preview -->
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-info">
                            <strong>Grade Preview:</strong>
                            @php
                                $percentage = ($mark->total_marks > 0) ? ($mark->obtained_marks / $mark->total_marks) * 100 : 0;
                                $grade = $percentage >= 90 ? 'A+' : 
                                        ($percentage >= 80 ? 'A' : 
                                        ($percentage >= 70 ? 'B' : 
                                        ($percentage >= 60 ? 'C' : 
                                        ($percentage >= 50 ? 'D' : 
                                        ($percentage >= 40 ? 'E' : 'F')))));
                                $color = $percentage >= 70 ? 'success' : 
                                        ($percentage >= 50 ? 'warning' : 
                                        ($percentage >= 40 ? 'info' : 'danger'));
                            @endphp
                            <span class="badge bg-{{ $color }}">{{ $grade }}</span>
                            <span class="ms-2">{{ number_format($percentage, 2) }}%</span>
                            <small class="text-muted ms-2">(This will update when you change marks)</small>
                        </div>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Marks
                    </button>
                    <a href="{{ route('teacher.marks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
// Auto-update grade preview when marks change
document.addEventListener('DOMContentLoaded', function() {
    const totalInput = document.querySelector('input[name="total_marks"]');
    const obtainedInput = document.querySelector('input[name="obtained_marks"]');
    const gradePreview = document.querySelector('.alert-info');

    if (totalInput && obtainedInput && gradePreview) {
        function updateGrade() {
            const total = parseFloat(totalInput.value) || 0;
            const obtained = parseFloat(obtainedInput.value) || 0;
            
            if (total > 0) {
                const percentage = (obtained / total) * 100;
                let grade, color;
                
                if (percentage >= 90) {
                    grade = 'A+';
                    color = 'success';
                } else if (percentage >= 80) {
                    grade = 'A';
                    color = 'success';
                } else if (percentage >= 70) {
                    grade = 'B';
                    color = 'success';
                } else if (percentage >= 60) {
                    grade = 'C';
                    color = 'warning';
                } else if (percentage >= 50) {
                    grade = 'D';
                    color = 'warning';
                } else if (percentage >= 40) {
                    grade = 'E';
                    color = 'info';
                } else {
                    grade = 'F';
                    color = 'danger';
                }
                
                gradePreview.innerHTML = `
                    <strong>Grade Preview:</strong>
                    <span class="badge bg-${color}">${grade}</span>
                    <span class="ms-2">${percentage.toFixed(2)}%</span>
                    <small class="text-muted ms-2">(This will update when you change marks)</small>
                `;
            }
        }

        totalInput.addEventListener('input', updateGrade);
        obtainedInput.addEventListener('input', updateGrade);
    }
});
</script>
@endsection