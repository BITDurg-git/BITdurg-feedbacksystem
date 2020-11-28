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
                @include('student.feedback.greetings')
            </div>
        </div>
    </div>
</div>
</div>

@endsection