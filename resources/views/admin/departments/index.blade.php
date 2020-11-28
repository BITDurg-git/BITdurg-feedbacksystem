@extends('admin.default')

@section('page-header')
    Departments <small>Manage all your departments</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.departments.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>HOD Name</th>
                    <th>HOD Email-Id</th>
                    <th>HOD Employee No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>HOD Name</th>
                    <th>HOD Email-Id</th>
                    <th>HOD Employee No.</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.departments.edit', $department->id) }}">{{ $department->department_name }}</a></td>
                        <td>{{ $department->department_code }}</td>
                        <td>{{$department->department_hod_name}}</td>
                        <td>{{$department->department_hod_email}}</td>
                        <td>{{$department->hod_emp_id}}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.departments.edit', $department->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.departments.destroy', $department->id), 
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