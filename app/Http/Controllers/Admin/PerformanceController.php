<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ExamType;
use App\Models\ExamTimetable;
use App\Models\Mark;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Overall Performance Dashboard
     */
    public function index()
    {
        $totalStudents = Student::count();
        $totalSubjects = Subject::count();
        $totalExams = ExamTimetable::count();
        $academicYears = AcademicYear::all();
        $classes = SchoolClass::all();
        $examTypes = ExamType::all();

        // Calculate performance metrics
        $metrics = $this->calculateMetrics();

        return view('admin.performance.index', compact(
            'totalStudents',
            'totalSubjects',
            'totalExams',
            'academicYears',
            'classes',
            'examTypes',
            'metrics'
        ));
    }

    /**
     * Filter Performance Data
     */
    public function filter(Request $request)
    {
        $query = Mark::with(['student', 'examTimetable'])->whereHas('examTimetable');

        if ($request->academic_year) {
            $query->whereHas('examTimetable', function($q) use ($request) {
                $q->where('academic_year_id', $request->academic_year);
            });
        }

        if ($request->class_id) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('school_class_id', $request->class_id);
            });
        }

        if ($request->exam_type) {
            $query->whereHas('examTimetable', function($q) use ($request) {
                $q->where('exam_type_id', $request->exam_type);
            });
        }

        $marks = $query->get();
        $filteredMetrics = $this->calculateFilteredMetrics($marks);

        return response()->json($filteredMetrics);
    }

    /**
     * Calculate Performance Metrics
     */
    private function calculateMetrics()
    {
        $marks = Mark::with('student')->whereHas('examTimetable')->get();

        if ($marks->isEmpty()) {
            return [
                'average_score' => 0,
                'pass_rate' => 0,
                'top_performers' => 0,
                'highest_score' => 0,
                'lowest_score' => 0,
                'total_students' => 0
            ];
        }

        $studentScores = [];
        $allScores = [];

        foreach ($marks->groupBy('student_id') as $studentId => $studentMarks) {
            $totalScore = 0;
            $subjectCount = $studentMarks->count();
            $passedSubjects = 0;

            foreach ($studentMarks as $mark) {
                $percentage = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
                $totalScore += $percentage;
                $allScores[] = $percentage;

                if ($percentage >= 40) {
                    $passedSubjects++;
                }
            }

            $average = ($subjectCount > 0) ? $totalScore / $subjectCount : 0;
            $studentScores[] = [
                'student_id' => $studentId,
                'average' => $average,
                'passed' => ($passedSubjects == $subjectCount)
            ];
        }

        $totalStudents = count($studentScores);
        $passedStudents = count(array_filter($studentScores, function($s) {
            return $s['passed'];
        }));

        $averages = array_column($studentScores, 'average');
        
        return [
            'average_score' => !empty($averages) ? round(array_sum($averages) / count($averages), 2) : 0,
            'pass_rate' => $totalStudents > 0 ? round(($passedStudents / $totalStudents) * 100, 2) : 0,
            'top_performers' => !empty($averages) ? count(array_filter($averages, function($score) {
                return $score >= 90;
            })) : 0,
            'highest_score' => !empty($averages) ? round(max($averages), 2) : 0,
            'lowest_score' => !empty($averages) ? round(min($averages), 2) : 0,
            'total_students' => $totalStudents
        ];
    }

    /**
     * Calculate Filtered Metrics
     */
    private function calculateFilteredMetrics($marks)
    {
        if ($marks->isEmpty()) {
            return [
                'average_score' => 0,
                'pass_rate' => 0,
                'top_performers' => 0,
                'highest_score' => 0,
                'lowest_score' => 0,
                'total_students' => 0
            ];
        }

        $studentScores = [];
        $allScores = [];

        foreach ($marks->groupBy('student_id') as $studentId => $studentMarks) {
            $totalScore = 0;
            $subjectCount = $studentMarks->count();
            $passedSubjects = 0;

            foreach ($studentMarks as $mark) {
                $percentage = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
                $totalScore += $percentage;
                $allScores[] = $percentage;

                if ($percentage >= 40) {
                    $passedSubjects++;
                }
            }

            $average = ($subjectCount > 0) ? $totalScore / $subjectCount : 0;
            $studentScores[] = [
                'student_id' => $studentId,
                'average' => $average,
                'passed' => ($passedSubjects == $subjectCount)
            ];
        }

        $totalStudents = count($studentScores);
        $passedStudents = count(array_filter($studentScores, function($s) {
            return $s['passed'];
        }));

        $averages = array_column($studentScores, 'average');
        
        return [
            'average_score' => !empty($averages) ? round(array_sum($averages) / count($averages), 2) : 0,
            'pass_rate' => $totalStudents > 0 ? round(($passedStudents / $totalStudents) * 100, 2) : 0,
            'top_performers' => !empty($averages) ? count(array_filter($averages, function($score) {
                return $score >= 90;
            })) : 0,
            'highest_score' => !empty($averages) ? round(max($averages), 2) : 0,
            'lowest_score' => !empty($averages) ? round(min($averages), 2) : 0,
            'total_students' => $totalStudents
        ];
    }

    /**
     * Get Top Performers List
     */
    public function topPerformers()
    {
        $students = Student::with(['marks', 'schoolClass'])->get();
        $topStudents = [];

        foreach ($students as $student) {
            $avg = $student->marks->avg(function($mark) {
                return ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            });
            
            if ($avg > 0) {
                $topStudents[] = [
                    'student' => $student,
                    'average' => round($avg, 2)
                ];
            }
        }

        usort($topStudents, function($a, $b) {
            return $b['average'] <=> $a['average'];
        });

        $topStudents = array_slice($topStudents, 0, 10);

        return view('admin.performance.top-performers', compact('topStudents'));
    }

    /**
     * Class-wise Performance
     */
    public function classPerformance($classId)
    {
        $class = SchoolClass::findOrFail($classId);
        $students = Student::where('school_class_id', $classId)->with('marks')->get();
        
        $performanceData = [];
        foreach ($students as $student) {
            $avg = $student->marks->avg(function($mark) {
                return ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            });
            
            $performanceData[] = [
                'student' => $student,
                'average' => round($avg, 2),
                'status' => $avg >= 40 ? 'Pass' : 'Fail'
            ];
        }

        return view('admin.performance.class', compact('class', 'performanceData'));
    }

    /**
     * Subject-wise Performance
     */
    public function subjectPerformance($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $marks = Mark::whereHas('examTimetable', function($q) use ($subjectId) {
            $q->where('subject_id', $subjectId);
        })->with(['student', 'examTimetable'])->get();

        $performanceData = [];
        foreach ($marks as $mark) {
            $score = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            $performanceData[] = [
                'student' => $mark->student,
                'marks_obtained' => $mark->marks_obtained,
                'total_marks' => $mark->total_marks,
                'percentage' => round($score, 2),
                'status' => $score >= 40 ? 'Pass' : 'Fail'
            ];
        }

        return view('admin.performance.subject', compact('subject', 'performanceData'));
    }

    /**
     * Student-wise Performance
     */
    public function studentPerformance($studentId)
    {
        $student = Student::with(['marks', 'schoolClass'])->findOrFail($studentId);
        $marks = $student->marks()->with('examTimetable')->get();

        $performanceData = [];
        foreach ($marks as $mark) {
            $score = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            $performanceData[] = [
                'exam' => $mark->examTimetable,
                'marks_obtained' => $mark->marks_obtained,
                'total_marks' => $mark->total_marks,
                'percentage' => round($score, 2),
                'status' => $score >= 40 ? 'Pass' : 'Fail'
            ];
        }

        $averageScore = $marks->avg(function($mark) {
            return ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
        });

        return view('admin.performance.student', compact('student', 'performanceData', 'averageScore'));
    }

    /**
     * Exam-wise Performance
     */
    public function examPerformance($examId)
    {
        $exam = ExamTimetable::with(['subject', 'schoolClass', 'section'])->findOrFail($examId);
        $marks = Mark::where('exam_timetable_id', $examId)->with('student')->get();

        $performanceData = [];
        $totalStudents = $marks->count();
        $passedStudents = 0;

        foreach ($marks as $mark) {
            $score = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            $status = $score >= 40 ? 'Pass' : 'Fail';
            
            if ($status == 'Pass') {
                $passedStudents++;
            }

            $performanceData[] = [
                'student' => $mark->student,
                'marks_obtained' => $mark->marks_obtained,
                'total_marks' => $mark->total_marks,
                'percentage' => round($score, 2),
                'status' => $status
            ];
        }

        $passRate = $totalStudents > 0 ? round(($passedStudents / $totalStudents) * 100, 2) : 0;

        return view('admin.performance.exam', compact(
            'exam', 
            'performanceData', 
            'passRate', 
            'totalStudents', 
            'passedStudents'
        ));
    }

    /**
     * Grade Distribution
     */
    public function gradeDistribution()
    {
        $marks = Mark::with('student')->get();
        $distribution = [
            'A+' => 0,
            'A' => 0,
            'B' => 0,
            'C' => 0,
            'D' => 0,
            'F' => 0
        ];

        foreach ($marks as $mark) {
            $percentage = ($mark->total_marks > 0) ? ($mark->marks_obtained / $mark->total_marks * 100) : 0;
            
            if ($percentage >= 90) $distribution['A+']++;
            elseif ($percentage >= 80) $distribution['A']++;
            elseif ($percentage >= 70) $distribution['B']++;
            elseif ($percentage >= 60) $distribution['C']++;
            elseif ($percentage >= 50) $distribution['D']++;
            else $distribution['F']++;
        }

        return view('admin.performance.grade-distribution', compact('distribution'));
    }
}