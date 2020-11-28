@extends('admin.default')

@section('page-header')
    Feedback Session <small>Showing all your feedback sessions.</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.feedback-sessions.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Feedback Name</th>
                    <th>Created At</th>
                    <th>Feedback Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Feedback Name</th>
                    <th>Created At</th>
                    <th>Feedback Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($feedback_forms as $feedback_form)
                    <tr>
                        <td>{{ $feedback_form->feedback_name }}</td>
                        <td>{{ $feedback_form->created_at->format('d F Y') }}</td>
                        <td>
                            @if($feedback_form->feedback_status == '1')
                            <span class="badge badge-pill badge-success lh-0 p-10">Running</span>
                            @endif
                        </td>
                        <td>
                            <ul class="list-inline">
                                @if ($feedback_form->feedback_status == 0)
                                <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.feedback-forms.edit', $feedback_form->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a>
                                </li>
                                @else
                                    
                                @endif
                                <li class="list-inline-item"> 
                                        <a href="{{ route(ADMIN . '.feedback-sessions.view', $feedback_form->id) }}" title="View Session" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>

                                </li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.feedback-sessions.stop-feedback', $feedback_form->id), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="Stop Feedback Session"><i class="ti-hand-stop"></i></button>
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection