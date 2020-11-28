@extends('admin.default')
@php
    use App\FeedbackForm;
@endphp
@section('page-header')
    Feedback Forms <small>Manage all your feedback forms.</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.feedback-forms.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Feedback Name</th>
                    <th>Created At</th>
                    <th>Batch Name</th>
                    <th>Student List</th>
                    <th>Lab/Theory</th>
                    <th>Feedback Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Feedback Name</th>
                    <th>Created At</th>
                    <th>Batch Name</th>
                    <th>Student List</th>
                    <th>Lab/Theory</th>
                    <th>Feedback Status</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($feedback_forms as $feedback_form)
                    <tr>
                        <td>{{ $feedback_form->feedback_name }}</td>
                        <td>{{ $feedback_form->created_at->format('d M y') }}</td>
                        <td>{{ $feedback_form->getBatch->batch_code }}</td>
                        <td><a href="{{ $feedback_form->student_list }}">Download</a></td>
                        <td>
                            @if($feedback_form->theory_lab == '0')
                            Theory 
                            @else 
                            Lab 
                            @endif
                        </td>
                        <td>
                                @if($feedback_form->feedback_status == '1')
                                <span class="badge badge-pill badge-success lh-0 p-10">Running</span>
                                @elseif($feedback_form->feedback_status == '0')
                                <span class="badge badge-pill badge-info lh-0 p-10">Newly Created</span>
                                @else
                                <span class="badge badge-pill badge-danger lh-0 p-10">Finished</span>
                                @endif
                        </td>
                        <td>
                            <ul class="list-inline">
                                    <li class="list-inline-item"> 
                                            <a href="{{ route(ADMIN . '.feedback-forms.show', $feedback_form->id) }}" title="View Form" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a>
    
                                    </li>
                                @if ($feedback_form->feedback_status == 0)
                                
                                @elseif($feedback_form->feedback_status == 2)
                                @can('viewAny', FeedbackForm::class)
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.feedback-forms.report', [$feedback_form->id,0]) }}" title="View report" class="btn btn-primary btn-sm"><span class="ti-receipt"></span></a>
                                </li>
                                @endcan
                                <li class="list-inline-item">
                                    <a href="{{ route('admin.feedback-forms.send-mail',[$feedback_form->id,0]) }}" title="Send Mail" class="btn btn-primary btn-sm"><span class="ti-email"></span></a>
                                </li>
                                @endif
                                @if ($feedback_form->feedback_status == 0 || $feedback_form->feedback_status == 2)
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.feedback-forms.destroy', $feedback_form->id), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection