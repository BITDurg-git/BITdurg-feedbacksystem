@extends('student.feedback')
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!--suppress JSUnresolvedLibraryURL -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section('content')
<div>

</div>
<div class="row">
    <div class="col-md-4 col-lg-4 has-{{count($relation_t)-count($relation_t_g)}}-items">
        
        @foreach ($relation_t as $eachrelation)
        @if ($eachrelation->group_name)
        @if ($eachrelation->group_name == $student->group_name)
        <div class="sidebar-item">
            <div class="make-me-sticky">
                <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100 pT-20 mB-20">
                            <div class="subject-info">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-4 col-lg-4">
                                        <img class="w-50r bdrs-50p" src="{{$eachrelation->getTeacher->avatar}}"
                                            alt="Avatar" class="avatar">
                                    </div>
                                    <div class="col-md-8 col-lg-8">
                                        <h1 class="c-grey-900">{{$eachrelation->getSubject->subject_name}}</h1>
                                        <h2 class="c-grey-900">Prof. {{$eachrelation->getTeacher->teacher_name}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
        @else
        <div class="sidebar-item">
            <div class="make-me-sticky">
                <div class="bd bgc-white">
                    <div class="layers">
                        <div class="layer w-100 pT-20 mB-20">
                            <div class="subject-info">
                                <div class="col-md-12 col-lg-12">
                                    <div class="col-md-4 col-lg-4">
                                        <img class="w-50r bdrs-50p" src="{{$eachrelation->getTeacher->avatar}}"
                                            alt="Avatar" class="avatar">
                                    </div>
                                    <div class="col-md-8 col-lg-8">
                                        <h1 class="c-grey-900">{{$eachrelation->getSubject->subject_name}}</h1>
                                        <h2 class="c-grey-900">Prof. {{$eachrelation->getTeacher->teacher_name}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif
        @endforeach

    </div>
    <div class="col-md-8 col-lg-8">
        <form id="form" method="post" action="/student/feedback/{{$feedbackForm->id}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="POST">
            {{-- Loop through each subject teacher relation of a batch. --}}
            @foreach ($relation_t as $eachrelation)
            {{-- Get main subject first --}}
            @if ($eachrelation->getSubject->type == 0)

            @if ($eachrelation->group_name)
            @if ($eachrelation->group_name == $student->group_name)
            <div class="bd bgc-white mB-20">
                <div class="layers">
                    <div class="layer w-100 pX-20 pT-20 mB-20">
                        <div class="questions">
                            <div class="col-md-12 col-lg" style="margin-top: 20px">
                                <table class="table table-bordered">
                                    <tbody>
                                        {{-- Loop through each questions --}}
                                        @foreach ($questions_t as $question)
                                        <tr>
                                            <td style="width:50%">{{$question->question}}</td>
                                            <td style="padding:30px">
                                                <input required
                                                    name="s{{$eachrelation->getTeacher->id}}{{$eachrelation->getSubject->id}}{{$question->id}}"
                                                    class="rating rating-loading" value="0" data-min="0" data-max="5"
                                                    data-step="1.0" data-size="sm">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="bd bgc-white mB-20">
                <div class="layers">
                    <div class="layer w-100 pX-20 pT-20 mB-20">
                        <div class="questions">
                            <div class="col-md-12 col-lg" style="margin-top: 20px">
                                <table class="table table-bordered">
                                    <tbody>
                                        {{-- Loop through each questions --}}
                                        @foreach ($questions_t as $question)
                                        <tr>
                                            <td style="width:50%">{{$question->question}}</td>
                                            <td style="padding:30px">
                                                <input required
                                                    name="s{{$eachrelation->getTeacher->id}}{{$eachrelation->getSubject->id}}{{$question->id}}"
                                                    class="rating rating-loading" value="0" data-min="0" data-max="5"
                                                    data-step="1.0" data-size="sm">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif




            @endif
            @endforeach

            {{-- For Lab --}}
            @foreach ($relation_l as $eachrelation)
            {{-- Get main subject first --}}
            @if ($eachrelation->getSubject->type == 0)
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="subject-info">
                        <div class="col-md-12 col-lg-12">
                            <div class="col-md-2 col-lg-2">
                                <img src="/storage/{{$eachrelation->getTeacher->avatar}}" alt="Avatar" class="avatar">
                            </div>
                            <div class="col-md-10 col-lg-10">
                                <h3>{{$eachrelation->getSubject->name}}</h2>
                                    <h5>Prof. {{$eachrelation->getTeacher->name}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="questions">
                        <div class="col-md-12 col-lg" style="margin-top: 20px">
                            <table class="table table-bordered">
                                <tbody>
                                    {{-- Loop through each questions --}}
                                    @foreach ($questions_l as $question)
                                    <tr>
                                        <td class="col-md-6 col-lg-6" style="ali">{{$question->question}}</td>
                                        <td class="col-md-6 col-lg-6" style="padding:30px">
                                            <input required name="s{{$eachrelation->getTeacher->id}}{{$eachrelation->getSubject->id}}{{$question->id}}"
                                                class="rating rating-loading" value="0" data-min="0" data-max="5"
                                                data-step="1.0" data-size="xs">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @endif
            @endforeach




            {{-- @if ($e1_r != null)
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="subject-info">
                        <div class="col-md-12 col-lg-12">
                            <div class="col-md-2 col-lg-2">
                                <img src="/storage/{{$e1_r->getTeacher->avatar}}" alt="Avatar" class="avatar">
    </div>
    <div class="col-md-10 col-lg-10">
        <h3>{{$e1_r->getSubject->name}}</h2>
            <h5>Prof. {{$e1_r->getTeacher->name}}</h5>
    </div>
</div>
</div>
<div class="questions">
    <div class="col-md-12 col-lg" style="margin-top: 20px">
        <table class="table table-bordered">
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td class="col-md-5 col-lg-5" style="ali">{{$question->question}}</td>
                    <td class="col-md-5 col-lg-5" style="padding:30px">
                        <input required name="e1{{$e1_r->getTeacher->id}}{{$question->id}}ee"
                            class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="1.0"
                            data-size="xs">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

@endif
@if ($e2_r != null)
<div class="panel panel-bordered">
    <div class="panel-body">
        <div class="subject-info">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-2 col-lg-2">
                    <img src="/storage/{{$e2_r->getTeacher->avatar}}" alt="Avatar" class="avatar">
                </div>
                <div class="col-md-10 col-lg-10">
                    <h3>{{$e2_r->getSubject->name}}</h2>
                        <h5>Prof. {{$e2_r->getTeacher->name}}</h5>
                </div>
            </div>
        </div>
        <div class="questions">
            <div class="col-md-12 col-lg" style="margin-top: 20px">
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td class="col-md-5 col-lg-5" style="ali">{{$question->question}}</td>
                            <td class="col-md-5 col-lg-5" style="padding:30px">
                                <input required name="e2{{$e2_r->getTeacher->id}}{{$question->id}}ee"
                                    class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="1.0"
                                    data-size="xs">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif --}}
<button id="btnSubmit" type="submit" class="btn-lg btn-primary save">Submit Feedback</button>

</form>
</div>
</div>
<script>
    $(document).ready(function () {

$("#form").submit(function (e) {

    //disable the submit button
    $("#btnSubmit").attr("disabled", "disabled");
    return true;

});
});
</script>
@endsection
@include('student.star')