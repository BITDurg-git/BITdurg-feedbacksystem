@extends('admin.default')

@section('page-header')
Feedback Report<small> Viewing your feedback report</small>
@endsection

@section('content')
<div class="mB-20 row">
        <div class="col-md-6 col-lg-6">
            <a href="{{ route('admin.feedback-forms.print-report',[$feedback_form->id,$attendence]) }}" class="btn c-white bgc-orange-500">
                Print Report
            </a>
            <a href="{{ route('admin.feedback-forms.send-mail',[$feedback_form->id,$attendence]) }}" class="btn c-white bgc-purple-500">
                    Send Mail
                </a>
        </div>
            <div class="col-md-6 col-lg-6">
                <div class="fl-r row">
                    <span>Filter Report above</span>
                <div class="col-md-3 col-lg-3">
                <input type="number" name="attendence" id="attendence" class="form-control" value="{{$attendence}}">
                </div>
                <span class="mR-10">% attendence</span>
                <button id="filter-btn" class="btn btn-primary">Filter</button>
                </div>
            </div>
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
                                <h3 class="text-right">{{$total_students}} students</h3>
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
                                    <td>{{$total_students}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Feedback Given By:</td>
                                    <td>{{$participatedStudent}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-600">Atendence Above:</td>
                                    <td>
                                        @if ($attendence == 0)
                                            All
                                        @else
                                            {{$attendence}}%
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('viewReport', \App\FeedbackForm::class)
    <div class="col-md-6 col-lg-6">
        @foreach ($reports_t as $report)
        @php
            $insideObject = $report[0];
            $feedback_arrays = $insideObject['feedback'];
        @endphp
            <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100">
                            <div class="bgc-light-green-500 c-white p-20">
                                <div class="peers ai-c jc-sb gap-40">
                                    <div class="peer peer-greed">
                                        <h5>{{$insideObject['name']}}</h5>
                                        <p class="mB-0">{{$insideObject['subject']}}</p>
                                    </div>
                                    <div class="peer">
                                        <h3 class="text-right">{{$insideObject['tpi']}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive p-20">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedback_arrays as $feedback_array)
                                        @php
                                            $feedback = $feedback_array[0];
                                        @endphp
                                            <tr>
                                            <td>{{$feedback['question']}}</td>
                                            <td>{{$feedback['points']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
    @endcan

</div>
<script type="text/javascript">
    window.onload = function(){
        document.getElementById("filter-btn").onclick = function(){
        window.location = "/admin/feedback-forms/report/"+{{$feedback_form->id}}+"/"+document.getElementById("attendence").value
        }
    }
</script>
@endsection
