@extends('admin.default')

@section('page-header')
Feedback Session<small> Running Feedback Session</small>
@endsection

@section('content')
<div class="mB-20">
    {!! Form::open([
    'class'=>'delete',
    'url' => route(ADMIN . '.feedback-sessions.stop-feedback', $feedback_form->id),
    'method' => 'DELETE',
    ])
    !!}

    <button href="{{ route('admin.feedback-sessions.stop-feedback',$feedback_form->id) }}"
        class="btn c-white bgc-red-500">
        Stop Feedback
    </button> {!! Form::close() !!}

</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
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
                                @include('admin.feedback-sessions.stopwatch')
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
                                    <td>{{count($students)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
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
                                <h3>{{count($students)}} Students</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-20">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Roll No.</th>
                                    <th>Attendence</th>
                                    <th>Elective 1</th>
                                    <th>Elective 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->urn}}</td>
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