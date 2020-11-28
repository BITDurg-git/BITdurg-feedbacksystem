<div class="row mB-40">
    <div class="col-md-6 col-lg-6">
        <div class="bgc-white p-20 bd mB-10">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    {!! Form::myTextArea('question','Question',['required']) !!}
                </div>
                <div class="col-md-6 col-lg-6">
                    {!! Form::mySelect('theory_lab','Theory/Lab',config('variables.theory_lab'),null,['class' =>
                    'form-control select2', 'placeholder' => 'Select', 'required']) !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">{{ trans('app.add_button') }}</button>

    </div>
    <div class="col-md-6 col-lg-6">
        <div class="bd bgc-white p-20">
            <div class="layers">
                <!-- Widget Title -->
                <div class="layer w-100 mB-20">
                    <h6 class="lh-1 text-dark">Instructions</h6>
                </div>
            </div>
            <ul>
                @foreach ($instructions as $instruction)
                <li class="text-dark mB-10">{{$instruction}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>