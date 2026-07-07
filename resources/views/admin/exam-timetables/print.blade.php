<!DOCTYPE html>
<html>

<head>

    <title>Exam Timetable</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            margin:30px;
            color:#000;
        }

        .header{
            text-align:center;
            margin-bottom:25px;
        }

        .header h1{
            margin:0;
            font-size:28px;
        }

        .header h2{
            margin:5px 0;
            font-size:22px;
        }

        .header h3{
            margin:5px 0;
            font-size:18px;
            font-weight:normal;
        }

        .info{
            margin-bottom:20px;
            font-size:16px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid #000;
        }

        th{
            background:#d9d9d9;
            padding:10px;
            font-size:15px;
        }

        td{
            padding:8px;
            text-align:center;
            font-size:14px;
        }

        .footer{
            margin-top:60px;
            display:flex;
            justify-content:space-between;
        }

        .signature{
            width:220px;
            text-align:center;
        }

        .line{
            border-top:1px solid black;
            margin-bottom:5px;
        }

        @media print{

            button{
                display:none;
            }

        }

    </style>

</head>

<body>

<div class="header">

    <h1>Your School Name</h1>

    <h2>Examination Timetable</h2>

    @if($examTimetables->count())

        <h3>{{ $examTimetables->first()->examType->name }}</h3>

        <h3>
            Academic Year :
            {{ $examTimetables->first()->academicYear->name }}
        </h3>

    @endif

</div>

<table>

    <thead>

        <tr>

            <th>Sr#</th>
            <th>Class</th>
            <th>Section</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Day</th>
            <th>Time</th>
            <th>Room</th>

        </tr>

    </thead>

    <tbody>

    @foreach($examTimetables as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->schoolClass->class_name }}</td>

            <td>{{ $item->section->section_name }}</td>

            <td>{{ $item->subject->subject_name }}</td>

            <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('d M Y') }}</td>

            <td>{{ \Carbon\Carbon::parse($item->exam_date)->format('l') }}</td>

            <td>
                {{ date('h:i A', strtotime($item->start_time)) }}
                -
                {{ date('h:i A', strtotime($item->end_time)) }}
            </td>

            <td>{{ $item->room }}</td>

        </tr>

    @endforeach

    </tbody>

</table>

<div class="footer">

    <div class="signature">

        <div class="line"></div>

        Exam Controller

    </div>

    <div class="signature">

        <div class="line"></div>

        Principal

    </div>

</div>

<script>

window.print();

</script>

</body>

</html>