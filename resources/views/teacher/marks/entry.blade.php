@extends('layouts.teacher')

@section('title', 'Enter Marks')

@section('content')

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-edit"></i> Enter Student Marks</h4>
        </div>
        
        <div class="card-body">
            <!-- Exam Details -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <strong>Exam</strong>
                    <p>{{ $examTimetable->examType->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Class</strong>
                    <p>{{ $examTimetable->schoolClass->class_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Section</strong>
                    <p>{{ $examTimetable->section->section_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-3">
                    <strong>Subject</strong>
                    <p><span class="badge bg-info">{{ $examTimetable->subject->subject_name ?? 'N/A' }}</span></p>
                </div>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('teacher.marks.save') }}" method="POST" id="marksForm">
                @csrf

                <input type="hidden" name="exam_timetable_id" value="{{ $examTimetable->id }}">
                <input type="hidden" name="exam_id" value="{{ $examTimetable->exam_id }}">
                <input type="hidden" name="subject_id" value="{{ $examTimetable->subject_id }}">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">#</th>
                                <th>Roll No</th>
                                <th>Student Name</th>
                                <th width="150">Total Marks</th>
                                <th width="180">Obtained Marks</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                @php
                                    $existingMark = $existingMarksData[$student->student_id][$examTimetable->subject_id] ?? null;
                                    $totalMarks = $examTimetable->subject->total_marks ?? 100;
                                    $obtainedMarks = $existingMark->obtained_marks ?? '';
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $student->roll_no ?? 'N/A' }}</strong></td>
                                    <td>{{ $student->student_name ?? 'N/A' }}</td>
                                    <td>
                                        <input type="number" 
                                               name="marks[{{ $student->student_id }}][total]" 
                                               class="form-control total-mark"
                                               value="{{ $totalMarks }}"
                                               min="1"
                                               required>
                                    </td>
                                    <td>
                                        <input type="number" 
                                               name="marks[{{ $student->student_id }}][obtained]" 
                                               class="form-control obtained-mark"
                                               data-student="{{ $student->student_id }}"
                                               value="{{ $obtainedMarks }}"
                                               placeholder="Enter marks"
                                               min="0"
                                               step="0.5"
                                               required
                                               oninput="validateMarks(this)">
                                    </td>
                                    <td>
                                        <input type="text" 
                                               name="marks[{{ $student->student_id }}][remarks]" 
                                               class="form-control" 
                                               value="{{ $existingMark->remarks ?? '' }}"
                                               placeholder="Remarks (optional)">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">
                                        <strong>No Students Found</strong>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Marks
                    </button>
                    <a href="{{ route('teacher.marks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function validateMarks(input) {
    const studentId = input.dataset.student;
    const totalInput = document.querySelector(`input[name="marks[${studentId}][total]"]`);
    const obtained = parseFloat(input.value) || 0;
    const total = parseFloat(totalInput.value) || 0;
    
    // Update max attribute
    input.max = total;
    
    // Validate
    if (obtained > total && total > 0) {
        input.style.borderColor = '#dc3545';
        input.style.boxShadow = '0 0 0 0.2rem rgba(220,53,69,0.25)';
        input.style.backgroundColor = '#fff5f5';
    } else if (obtained < 0) {
        input.style.borderColor = '#dc3545';
        input.style.boxShadow = '0 0 0 0.2rem rgba(220,53,69,0.25)';
        input.style.backgroundColor = '#fff5f5';
    } else {
        input.style.borderColor = '#28a745';
        input.style.boxShadow = '0 0 0 0.2rem rgba(40,167,69,0.25)';
        input.style.backgroundColor = '#f8fff8';
    }
}

// Auto-validate on page load
document.addEventListener('DOMContentLoaded', function() {
    const obtainedInputs = document.querySelectorAll('.obtained-mark');
    
    obtainedInputs.forEach(input => {
        validateMarks(input);
    });
    
    // Add focus/blur effects
    const inputs = document.querySelectorAll('.obtained-mark, .total-mark');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#007bff';
            this.style.boxShadow = '0 0 0 0.2rem rgba(0,123,255,0.25)';
        });
        input.addEventListener('blur', function() {
            if (this.classList.contains('obtained-mark')) {
                validateMarks(this);
            } else {
                this.style.borderColor = '#ced4da';
                this.style.boxShadow = 'none';
            }
        });
    });
    
    // Re-validate when total marks change
    const totalInputs = document.querySelectorAll('.total-mark');
    totalInputs.forEach(input => {
        input.addEventListener('change', function() {
            const studentId = this.name.match(/\d+/)[0];
            const obtainedInput = document.querySelector(`input[name="marks[${studentId}][obtained]"]`);
            if (obtainedInput) {
                validateMarks(obtainedInput);
            }
        });
    });
});

// Validate marks before submission
document.getElementById('marksForm').addEventListener('submit', function(e) {
    const obtainedInputs = document.querySelectorAll('.obtained-mark');
    let hasError = false;
    let errorMessage = '';
    
    obtainedInputs.forEach(input => {
        const studentId = input.dataset.student;
        const totalInput = document.querySelector(`input[name="marks[${studentId}][total]"]`);
        const obtained = parseFloat(input.value) || 0;
        const total = parseFloat(totalInput.value) || 0;
        const studentName = input.closest('tr').querySelector('td:nth-child(3)').textContent;
        
        if (obtained > total && total > 0) {
            errorMessage += `✗ ${studentName}: Obtained marks (${obtained}) cannot exceed total marks (${total}).\n`;
            hasError = true;
        } else if (obtained < 0) {
            errorMessage += `✗ ${studentName}: Obtained marks cannot be negative.\n`;
            hasError = true;
        }
    });
    
    if (hasError) {
        e.preventDefault();
        alert('Please fix the following errors:\n\n' + errorMessage);
    }
});
</script>
@endpush

<style>
.obtained-mark {
    transition: all 0.3s ease;
    border: 2px solid #007bff;
    background-color: #ffffff;
}
.obtained-mark:focus {
    border-color: #007bff !important;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25) !important;
    background-color: #f0f8ff !important;
}
.obtained-mark:hover {
    background-color: #f8f9fa;
}
.total-mark {
    background-color: #e9ecef;
    border: 2px solid #ced4da;
    font-weight: bold;
}
.total-mark:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}
.table td {
    vertical-align: middle;
}
.form-control {
    border-radius: 0.375rem;
    font-size: 0.95rem;
}
.table th {
    white-space: nowrap;
}
.table td input {
    min-width: 80px;
}
</style>