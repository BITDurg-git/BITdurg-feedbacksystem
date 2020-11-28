@extends('admin.default')

@section('page-header')
    Courses <small>Manage all your courses.</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.courses.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Semester Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Semester Count</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.courses.edit', $course->id) }}">{{ $course->course_name }}</a></td>
                        <td>{{$course->getDepartment->department_name}}</td>
                        <td>{{ $course->semester_count }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.courses.edit', $course->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.courses.destroy', $course->id), 
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