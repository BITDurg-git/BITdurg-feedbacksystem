@extends('admin.default')

@section('page-header')
    Subjects <small>Manage all your subjects</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.subjects.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Semester</th>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Main/Elective</th>
                    <th>Theory/Lab</th>
                    <th>Actions</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Semester</th>
                    <th>Course Name</th>
                    <th>Department Name</th>
                    <th>Main/Elective</th>
                    <th>Theory/Lab</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.subjects.edit', $subject->id) }}">{{ $subject->subject_name }}</a></td>
                        <td>{{ $subject->subject_code }}</td>
                        <td>{{ $subject->semester }}</td>
                        <td>{{ $subject->getCourse->course_name }}</td>
                        <td>{{ $subject->getDepartment->department_name }}</td>
                        @if ($subject->main_elective == 0)
                            <td>Main</td>
                        @else
                            <td>Elective</td>
                        @endif
                        @if ($subject->theory_lab == 0)
                            <td>Theory</td>
                        @else
                            <td>Lab</td>
                        @endif
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.subjects.edit', $subject->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.subjects.destroy', $subject->id), 
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