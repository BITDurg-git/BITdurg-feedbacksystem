@extends('admin.default')

@section('page-header')
    Teacher-Subject Relation Maping <small>Manage all your teacher subject relation.</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.relations.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Teacher Name</th>
                    <th>Batch Name</th>
                    <th>Group Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Subject Name</th>
                    <th>Teacher Name</th>
                    <th>Batch Name</th>

                    <th>Group Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($relations as $relation)
                    <tr>
                        <td>{{ $relation->getSubject->subject_name }}
                            @if ($relation->getSubject->main_elective == 0)
                            (Main)
                            @else
                            (Elective)
                            @endif
                        </td>
                        <td>{{ $relation->getTeacher->teacher_name }}</td>
                        <td>{{ $relation->getBatch->batch_code }}</td>
                        @if ($relation->group_name)
                        <td>{{ $relation->group_name }}</td>
                        @else
                        <td>N/A</td>
                        @endif
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.relations.edit', $relation->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.relations.destroy', $relation->id), 
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