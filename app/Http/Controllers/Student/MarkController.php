<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Mark;
use App\Models\ExamTimetable;
use App\Models\Student;

class MarkController extends Controller
{
    /**
     * Get the authenticated student.
     */
    private function getStudent()
    {
        $user = Auth::user();
        
        if ($user->role !== 'student') {
            abort(403, 'Access denied. Student only area.');
        }
        
        $student = Student::where('user_id', $user->id)->first();
        
        if (!$student) {
            abort(404, 'Student profile not found.');
        }
        
        return $student;
    }

    /**
     * Display a listing of the student's marks.
     */
    public function index()
    {
        $student = $this->getStudent();

        $marks = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->orderBy('exam_timetable_id', 'desc')
        ->get();

        return view('student.marks.index', compact('marks', 'student'));
    }

    /**
     * Display the specified mark details.
     */
    public function show(ExamTimetable $examTimetable)
    {
        $student = $this->getStudent();

        $mark = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->where('exam_timetable_id', $examTimetable->id)
        ->first();

        if (!$mark) {
            abort(404, 'Marks not found for this exam');
        }

        $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
        $grade = $this->calculateGrade($percentage);
        $status = ($percentage >= 40) ? 'Pass' : 'Fail';

        return view('student.marks.show', compact('mark', 'student', 'percentage', 'grade', 'status'));
    }

    /**
     * Print the mark details.
     */
    public function print(ExamTimetable $examTimetable)
    {
        $student = $this->getStudent();

        $mark = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->where('exam_timetable_id', $examTimetable->id)
        ->first();

        if (!$mark) {
            abort(404, 'Marks not found for this exam');
        }

        $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
        $grade = $this->calculateGrade($percentage);
        $status = ($percentage >= 40) ? 'Pass' : 'Fail';

        return view('student.marks.print', compact('mark', 'student', 'percentage', 'grade', 'status'));
    }

    /**
     * Download mark details as PDF.
     */
    public function downloadPdf(ExamTimetable $examTimetable)
    {
        $student = $this->getStudent();

        $mark = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->where('exam_timetable_id', $examTimetable->id)
        ->first();

        if (!$mark) {
            abort(404, 'Marks not found for this exam');
        }

        $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
        $grade = $this->calculateGrade($percentage);
        $status = ($percentage >= 40) ? 'Pass' : 'Fail';

        $pdf = Pdf::loadView('student.marks.pdf', compact('mark', 'student', 'percentage', 'grade', 'status'));
        return $pdf->download('marks_' . $student->id . '_' . $examTimetable->id . '.pdf');
    }

    /**
     * Display the performance card.
     */
    public function performanceCard()
    {
        $student = $this->getStudent();

        $marks = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->orderBy('exam_timetable_id', 'desc')
        ->get();

        // Calculate overall statistics
        $totalMarks = $marks->sum('total_marks');
        $obtainedMarks = $marks->sum('obtained_marks');
        $overallPercentage = ($totalMarks > 0) ? round(($obtainedMarks / $totalMarks) * 100, 2) : 0;
        $overallGrade = $this->calculateGrade($overallPercentage);

        // Group marks by subject
        $subjectMarks = [];
        foreach ($marks as $mark) {
            $subjectId = $mark->subject_id;
            if (!isset($subjectMarks[$subjectId])) {
                $subjectMarks[$subjectId] = [
                    'subject_name' => $mark->subject->subject_name ?? 'N/A',
                    'total' => 0,
                    'obtained' => 0,
                    'count' => 0,
                ];
            }
            $subjectMarks[$subjectId]['total'] += $mark->total_marks;
            $subjectMarks[$subjectId]['obtained'] += $mark->obtained_marks;
            $subjectMarks[$subjectId]['count']++;
        }

        // Calculate percentage and grade for each subject
        foreach ($subjectMarks as &$subject) {
            $subject['percentage'] = ($subject['total'] > 0) ? round(($subject['obtained'] / $subject['total']) * 100, 2) : 0;
            $subject['grade'] = $this->calculateGrade($subject['percentage']);
        }

        // Get student's roll number from enrollments
        $enrollment = $student->enrollments()->latest()->first();
        $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

        return view('student.marks.performance-card', compact(
            'student',
            'marks',
            'subjectMarks',
            'overallPercentage',
            'overallGrade',
            'totalMarks',
            'obtainedMarks'
        ));
    }

    /**
     * Print the performance card.
     */
    public function printPerformanceCard()
    {
        $student = $this->getStudent();

        $marks = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->orderBy('exam_timetable_id', 'desc')
        ->get();

        // Calculate overall statistics
        $totalMarks = $marks->sum('total_marks');
        $obtainedMarks = $marks->sum('obtained_marks');
        $overallPercentage = ($totalMarks > 0) ? round(($obtainedMarks / $totalMarks) * 100, 2) : 0;
        $overallGrade = $this->calculateGrade($overallPercentage);

        // Group marks by subject
        $subjectMarks = [];
        foreach ($marks as $mark) {
            $subjectId = $mark->subject_id;
            if (!isset($subjectMarks[$subjectId])) {
                $subjectMarks[$subjectId] = [
                    'subject_name' => $mark->subject->subject_name ?? 'N/A',
                    'total' => 0,
                    'obtained' => 0,
                    'count' => 0,
                ];
            }
            $subjectMarks[$subjectId]['total'] += $mark->total_marks;
            $subjectMarks[$subjectId]['obtained'] += $mark->obtained_marks;
            $subjectMarks[$subjectId]['count']++;
        }

        // Calculate percentage and grade for each subject
        foreach ($subjectMarks as &$subject) {
            $subject['percentage'] = ($subject['total'] > 0) ? round(($subject['obtained'] / $subject['total']) * 100, 2) : 0;
            $subject['grade'] = $this->calculateGrade($subject['percentage']);
        }

        // Get student's roll number from enrollments
        $enrollment = $student->enrollments()->latest()->first();
        $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

        return view('student.marks.print-performance-card', compact(
            'student',
            'marks',
            'subjectMarks',
            'overallPercentage',
            'overallGrade',
            'totalMarks',
            'obtainedMarks'
        ));
    }

    /**
     * Download performance card as PDF.
     */
    public function downloadPerformanceCardPdf()
    {
        $student = $this->getStudent();

        $marks = Mark::with([
            'examTimetable.examType',
            'examTimetable.schoolClass',
            'examTimetable.section',
            'subject'
        ])
        ->where('student_id', $student->id)
        ->orderBy('exam_timetable_id', 'desc')
        ->get();

        // Calculate overall statistics
        $totalMarks = $marks->sum('total_marks');
        $obtainedMarks = $marks->sum('obtained_marks');
        $overallPercentage = ($totalMarks > 0) ? round(($obtainedMarks / $totalMarks) * 100, 2) : 0;
        $overallGrade = $this->calculateGrade($overallPercentage);

        // Group marks by subject
        $subjectMarks = [];
        foreach ($marks as $mark) {
            $subjectId = $mark->subject_id;
            if (!isset($subjectMarks[$subjectId])) {
                $subjectMarks[$subjectId] = [
                    'subject_name' => $mark->subject->subject_name ?? 'N/A',
                    'total' => 0,
                    'obtained' => 0,
                    'count' => 0,
                ];
            }
            $subjectMarks[$subjectId]['total'] += $mark->total_marks;
            $subjectMarks[$subjectId]['obtained'] += $mark->obtained_marks;
            $subjectMarks[$subjectId]['count']++;
        }

        // Calculate percentage and grade for each subject
        foreach ($subjectMarks as &$subject) {
            $subject['percentage'] = ($subject['total'] > 0) ? round(($subject['obtained'] / $subject['total']) * 100, 2) : 0;
            $subject['grade'] = $this->calculateGrade($subject['percentage']);
        }

        // Get student's roll number from enrollments
        $enrollment = $student->enrollments()->latest()->first();
        $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

        $pdf = Pdf::loadView('student.marks.pdf-performance-card', compact(
            'student',
            'marks',
            'subjectMarks',
            'overallPercentage',
            'overallGrade',
            'totalMarks',
            'obtainedMarks'
        ));
        
        return $pdf->download('performance_card_' . $student->id . '.pdf');
    }
/**
 * Display transcript/DMC for a specific exam.
 */
public function transcript(ExamTimetable $examTimetable)
{
    $student = $this->getStudent();

    $mark = Mark::with([
        'examTimetable.examType',
        'examTimetable.schoolClass',
        'examTimetable.section',
        'subject',
        'examTimetable.academicYear'
    ])
    ->where('student_id', $student->id)
    ->where('exam_timetable_id', $examTimetable->id)
    ->first();

    if (!$mark) {
        abort(404, 'Marks not found for this exam');
    }

    $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
    $grade = $this->calculateGrade($percentage);
    $status = ($percentage >= 40) ? 'Pass' : 'Fail';

    // Get student's roll number
    $enrollment = $student->enrollments()->latest()->first();
    $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

    return view('student.marks.transcript', compact(
        'mark', 
        'student', 
        'examTimetable', 
        'percentage', 
        'grade', 
        'status'
    ));
}

/**
 * Print transcript/DMC.
 */
public function printTranscript(ExamTimetable $examTimetable)
{
    $student = $this->getStudent();

    $mark = Mark::with([
        'examTimetable.examType',
        'examTimetable.schoolClass',
        'examTimetable.section',
        'subject',
        'examTimetable.academicYear'
    ])
    ->where('student_id', $student->id)
    ->where('exam_timetable_id', $examTimetable->id)
    ->first();

    if (!$mark) {
        abort(404, 'Marks not found for this exam');
    }

    $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
    $grade = $this->calculateGrade($percentage);
    $status = ($percentage >= 40) ? 'Pass' : 'Fail';

    // Get student's roll number
    $enrollment = $student->enrollments()->latest()->first();
    $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

    return view('student.marks.print-transcript', compact(
        'mark', 
        'student', 
        'examTimetable', 
        'percentage', 
        'grade', 
        'status'
    ));
}

/**
 * Download transcript/DMC as PDF.
 */
public function downloadTranscriptPdf(ExamTimetable $examTimetable)
{
    $student = $this->getStudent();

    $mark = Mark::with([
        'examTimetable.examType',
        'examTimetable.schoolClass',
        'examTimetable.section',
        'subject',
        'examTimetable.academicYear'
    ])
    ->where('student_id', $student->id)
    ->where('exam_timetable_id', $examTimetable->id)
    ->first();

    if (!$mark) {
        abort(404, 'Marks not found for this exam');
    }

    $percentage = ($mark->total_marks > 0) ? round(($mark->obtained_marks / $mark->total_marks) * 100, 2) : 0;
    $grade = $this->calculateGrade($percentage);
    $status = ($percentage >= 40) ? 'Pass' : 'Fail';

    // Get student's roll number
    $enrollment = $student->enrollments()->latest()->first();
    $student->roll_no = $enrollment ? $enrollment->roll_no : 'N/A';

    $pdf = Pdf::loadView('student.marks.pdf-transcript', compact(
        'mark', 
        'student', 
        'examTimetable', 
        'percentage', 
        'grade', 
        'status'
    ));
    
    return $pdf->download('transcript_' . $student->id . '_' . $examTimetable->id . '.pdf');
}
    /**
     * Calculate grade based on percentage.
     */
    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) {
            return ['letter' => 'A+', 'color' => 'success', 'description' => 'Outstanding'];
        } elseif ($percentage >= 80) {
            return ['letter' => 'A', 'color' => 'success', 'description' => 'Excellent'];
        } elseif ($percentage >= 70) {
            return ['letter' => 'B', 'color' => 'success', 'description' => 'Very Good'];
        } elseif ($percentage >= 60) {
            return ['letter' => 'C', 'color' => 'warning', 'description' => 'Good'];
        } elseif ($percentage >= 50) {
            return ['letter' => 'D', 'color' => 'warning', 'description' => 'Fair'];
        } elseif ($percentage >= 40) {
            return ['letter' => 'E', 'color' => 'info', 'description' => 'Pass'];
        } else {
            return ['letter' => 'F', 'color' => 'danger', 'description' => 'Fail'];
        }
    }
}