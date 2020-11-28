@extends('admin.default')

@section('page-header')
    Batches <small>Manage all your batches</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.batches.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Batch Code</th>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Batch Code</th>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($batches as $batch)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.batches.edit', $batch->id) }}">{{ $batch->batch_code }}</a></td>
                        <td>{{ $batch->getCourse->course_name }}</td>
                        <td>{{ $batch->getDepartment->department_name }}</td>
                        <td>{{ $batch->semester }}</td>
                        <td>{{ $batch->section }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.batches.edit', $batch->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.batches.destroy', $batch->id), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
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