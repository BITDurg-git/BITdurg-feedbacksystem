@extends('admin.default')

@section('page-header')
    Teachers <small>Manage all your teachers</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.teachers.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Email Id</th>
                    <th>Employee Id</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Email Id</th>
                    <th>Employee Id</th>
                    <th>Avatar</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.teachers.edit', $teacher->id) }}">{{ $teacher->teacher_name }}</a></td>
                        <td>{{ $teacher->getDepartment->department_name }}</td>
                        <td>{{$teacher->email_id}}</td>
                        <td>{{$teacher->emp_id}}</td>
                        <td><img class="w-5r bdrs-50p" src="{{$teacher->avatar}}" alt=""></td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.teachers.edit', $teacher->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.teachers.destroy', $teacher->id), 
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