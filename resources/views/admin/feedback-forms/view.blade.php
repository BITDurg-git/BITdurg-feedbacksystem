@extends('admin.default')

@section('page-header')
Feedback Form<small> Viewing feedback form {{$feedback_form->feedback_name}}</small>
@endsection

@section('content')
<div class="mB-20">
    {!! Form::open([
    'class'=>'delete',
    'url' => route(ADMIN . '.feedback-forms.destroy', $feedback_form->id),
    'method' => 'DELETE',
    ])
    !!}
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100">
                    <div class="bgc-cyan-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>{{$feedback_form->feedback_name}}</h5>
                                <p class="mB-0">{{$feedback_form->created_at->format('d F Y')}}</p>
                            </div>
                            <div class="peer">
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="fw-600">Department Name: </td>
                                    <td>{{$feedback_form->getBatch->getDepartment->department_code}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Course Name:</td>
                                    <td>{{$feedback_form->getBatch->getCourse->course_name}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Semester:</td>
                                    <td>{{$feedback_form->getBatch->semester}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Section:</td>
                                    <td>{{$feedback_form->getBatch->section}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Group Name:</td>
                                    <td>{{$feedback_form->getBatch->group_name}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Total Students Count:</td>
                                    <td>{{count($feedback_form->students)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="bd bgc-white">
            <div class="layers">
                <div class="layer w-100">
                    <div class="bgc-green-500 c-white p-20">
                        <div class="peers ai-c jc-sb gap-40">
                            <div class="peer peer-greed">
                                <h5>Student List</h5>
                                <p class="mB-0">{{$feedback_form->created_at->format('d F Y')}}</p>
                            </div>
                            <div class="peer">
                                <h3>{{count($feedback_form->students)}} Students</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Roll No.</th>
                                    <th>Group Name</th>
                                    <th>Attendence</th>
                                    <th>Elective 1</th>
                                    <th>Elective 2</th>
                                    @if ($feedback_form->getBatch->department_name == 11)
                                    <th>Elective 3</th>
                                    <th>Elective 4</th>
                                    @if ($feedback_form->getBatch->department_name == 11)
                                        <th>Elective 5</th>
                                        <th>Elective 6</th>
                                        <th>Elective 7</th>
                                        <th>Elective 8</th>
                                        <th>Elective 9</th>
                                        <th>Elective 10</th>
                                    @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedback_form->students as $student)
                                <tr>
                                <td><a href="{{ route('admin.students.edit', $student->id)}}">{{$student->name}}</a></td>
                                    <td>{{$student->urn}}</td>
                                    @if ($student->group_name)
                        <td>{{ $student->group_name }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                                    <td>{{$student->attendence}}</td>
                                    @if ($student->e1)
                                        <td>{{$student->e1->subject_name}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    @if ($student->e2)
                                        <td>{{$student->e2->subject_name}}</td>
                                    @else
                                    <td>
                                        N/A
                                    </td>
                                    @endif
                                    @if ($feedback_form->getBatch->department_name == 11)
                                    @if ($student->e3)
                                    <td>{{$student->e3->subject_name}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    @if ($student->e4)
                                    <td>{{$student->e4->subject_name}}</td>
                                    @else 
                                    <td>N/A</td>
                                    @endif
                                    @endif
                                    @if ($feedback_form->getBatch->department_name == 11)
                                    @if ($student->e5)
                                        <td>{{$student->e5->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @if ($student->e6)
                                        <td>{{$student->e6->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @if ($student->e7)
                                    <td>{{$student->e7->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @if ($student->e8)
                                    <td>{{$student->e8->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @if ($student->e9)
                                    <td>{{$student->e9->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @if ($student->e10)
                                    <td>{{$student->e10->subject_name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection