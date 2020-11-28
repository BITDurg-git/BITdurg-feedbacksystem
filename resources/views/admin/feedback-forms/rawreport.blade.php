@php
    $index = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$feedback_form->feedback_name}}</title>
</head>
<body>
        <div style="width: 100%;margin: 0 auto;">
                <h3 style="text-align: center">Bhilai Institute of Technology, Durg</h1>
                <h3 style="text-align: center; "><u>Feedback Report</u></h3>
                    @php
                        $c = 0;
                    @endphp
            
                @foreach ($reports_t as $report)
                    @php
                    $c = $c + 1;
                        $insideObject = $report[0];
                        $feedback_arrays = $insideObject['feedback'];
                    @endphp
                    {{-- @if ($c == 6)
                        {{dd($report)}}
                    @endif --}}
                    @if ($report[0]['attempted'] !== 0)
                    <table border="1" style="font-size:10px; margin:auto; width:80%; border-collapse: collapse; padding: 3px; margin-bottom:10px">
                        <tbody>
                                <tr>
                                        <td style="width:25%; padding:3px">Academic Year</td>
                                        <td style="width:25%; padding:3px">{{$academic_session->value}}</td>
                                        <td style="width:25%; padding:3px">Name of the Faculty</td>
                                        <td style="width:25%; padding:3px"><b>Prof. {{$insideObject['name']}}</b></td>
                                    </tr>
                                        <tr>
                                            <td style="width:25%; padding:3px">Subject Taught</td>
                                            <td style="width:25%; padding:3px"><b>{{$insideObject['subject']}}({{$insideObject['subject_code']}})</b></td>
                                            <td style="width:25%; padding:3px">Department</td>
                                        <td style="width:25%; padding:3px">{{$feedback_form->getBatch->getDepartment->department_name}}</td>
                                        </tr>
                                    <tr>
                                        <td style="width:25%; padding:3px">Course</td>
                                        <td style="width:25%; padding:3px">{{$feedback_form->getBatch->getCourse->course_name}}</td>
                                        <td style="width:25%; padding:3px">Semester</td>
                                        <td style="width:25%; padding:3px">{{$feedback_form->getBatch->semester}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%; padding:3px">Section</td>
                                        <td style="width:25%; padding:3px">{{$insideObject['section']}}</td>
                                        <td style="width:25%; padding:3px">Date of the Feedback</td>
                                            <td style="width:25%; padding:3px">{{$feedback_form->updated_at->format('d-m-Y')}}</td>
                                    </tr>
                        
                                    <tr>
                                        <td style="width:25%; padding:3px">Total number of students</td>
                                        <td style="width:25%; padding:3px">{{$insideObject['total_students']}}</td>
                                        <td style="width:25%; padding:3px">Number of students given feedback</td>
                                        <td style="width:25%; padding:3px">{{$insideObject['attempted']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:25%; padding:3px">Attendance Above:</td>
                                        <td style="width:25%; padding:3px">
                                            @if ($attendence == 0)
                                                All
                                            @else
                                                {{$attendence}}%
                                            @endif
                                        </td>
                                        <td style="width:25%; padding:3px"></td>
                                        <td style="width:25%; padding:3px"></td>
                                    </tr>
                        </tbody>
                    </table>
                    <table border="1" style="font-size:10px; margin:auto; width:80%; border-collapse: collapse; padding: 3px; margin-bottom:20px">
                        <thead>
                            <th style="width:10%; padding:3px"><b>S. No.</b></th>
                            <th style="width:50%; padding:3px"><b>Description</b></th>
                            <th style="width:50%; padding:3px"><b>Score(out of 5)</b></th>
                        </thead>
                        @php
                            $qindex=0
                        @endphp
                            <tbody>
                                @foreach ($feedback_arrays as $feedback_array)
                                @php
                                    $feedback = $feedback_array[0];
                                    $qindex= $qindex + 1;
                                @endphp
                                    <tr>
                                        <td style="width:1%; text-align: center;  padding:3px">{{$qindex}}</td>
                                        <td style="width:70%; padding:3px">{{$feedback['question']}}</td>
                                        <td style="width:30%; text-align: center;  padding:3px">{{$feedback['points']}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                        <td style="width:1%; text-align: center; padding:3px"></td>
            
                                    <td style="width:70%; padding:3px"><b>Total Performance Index (out of {{$insideObject['tpitotal']}})</b></td>
                                    <td style="width:30%; text-align: center;  padding:3px"><b>{{$insideObject['tpi']}}</b></td>
                                </tr>
                                <tr>
                                        <td style="width:1%;text-align: center;  padding:3px"></td>
            
                                    <td style="width:70%; padding:3px"><b>Total Performance Index (out of 5)</b></td>
                                    <td style="width:30%; text-align: center;  padding:3px"><b>{{$insideObject['tpi5']}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                        
                        @php
                            $index = $index + 1;
                        @endphp
                        @if ($index%2 == 0)
                        <div class="page-break"></div>
            
                        @endif
                        @endforeach
            </div>
            <style>
                @media all {
            .page-break { display: none; }
            }
            
            @media print {
            .page-break { display: block; page-break-before: always; }
            }
            </style>
</body>
</html>