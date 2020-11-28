@extends('student.default2')

@section('page-header')
Welcome <small>{{Auth::user()->name}}</small>
@endsection

@section('content')
<div class="masonry-item col-md-12">
    <!-- #Sales Report ==================== -->
    <div class="bd bgc-white">
        <div class="layers">
            <div class="layer w-100 p-20">
                <h6 class="lh-1">Welcome, {{Auth::user()->name}}</h6>
            </div>
            <div class="layer w-100">
                <div class="bgc-cyan-500 c-white p-20">
                    <div class="peers ai-c jc-sb gap-40">
                        <div class="peer peer-greed">
                        <h5>{{$date}}</h5>
                            <p class="mB-0">{{$day}}</p>
                        </div>
                        <div class="peer">
                        <h3 class="text-right">{{$greetings}}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-20">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class=" bdwT-0">Name</th>
                                <th class=" bdwT-0">Status</th>
                                <th class=" bdwT-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $feedback)
                            @if (($feedback->getFeedback != null && $feedback->getFeedback->feedback_status == 1) || $feedback->getFeedback->feedback_status == 2)
                            <tr>
                                    <td class="fw-600">{{$feedback->getFeedback->feedback_name}}</td>

                                    @if ($feedback->getFeedback->feedback_status == 2)
                                    <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Finished</span> </td>
                                    @if ($feedback->feedback_status == 1)
                                        <td>{{$feedback->updated_at->format('d F Y')}}</td>
                                    @else
                                        <td><span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Not Given</span> </td>
                                    @endif
                                    @else
                                    <td><span class="badge bgc-green-50 c-green-700 p-10 lh-0 tt-c badge-pill">Active</span> </td>
                                    @if ($feedback->feedback_status == 1)
                                    <td><span class="badge bgc-green-50 c-green-700 p-10 lh-0 tt-c badge-pill">Completed</span> </td>


                                    @else
                                    <td>
                                            <button class="btn btn-primary bdrs-50p w-2r p-0 h-2r" type="button" onclick="window.location = '/student/feedback/{{$feedback->getFeedback->id}}'">
                                                            <i class="fa fa-paper-plane-o"></i>
                                                        </button>
                                    </td>
                                    @endif
                                    @endif

                                </tr>
                                
                            @endif
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