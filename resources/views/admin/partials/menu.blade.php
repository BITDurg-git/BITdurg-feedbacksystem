@php
use App\Department;
use App\Course;
use App\Question;
use App\Setting;
$r = \Route::current()->getAction();
$route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item mT-30">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.dash') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.dash') }}">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>
@can('viewAny', Department::class)
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.departments') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.departments.index') }}">
        <span class="icon-holder">
            <i class="c-pink-500 ti-blackboard"></i>
        </span>
        <span class="title">College Departments</span>
    </a>
</li>
@endcan
@can('viewAny', Course::class)
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.courses') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.courses.index') }}">
        <span class="icon-holder">
            <i class="c-orange-500 ti-files"></i>
        </span>
        <span class="title">Course List</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.subjects') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.subjects.index') }}">
        <span class="icon-holder">
            <i class="c-purple-500 ti-book"></i>
        </span>
        <span class="title">Subject List</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.teachers') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.teachers.index') }}">
        <span class="icon-holder">
            <i class="c-purple-500 ti-bookmark-alt"></i>
        </span>
        <span class="title">Teachers/Faculty</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.batches') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.batches.index') }}">
        <span class="icon-holder">
            <i class="c-magneto-500 ti-package"></i>
        </span>
        <span class="title">Student Batches</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.realtions') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.relations.index') }}">
        <span class="icon-holder">
            <i class="c-cyan-500 ti-id-badge"></i>
        </span>
        <span class="title">Teacher-Subject Relation</span>
    </a>
</li>
@can('viewAny', Question::Class)
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.questions') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.questions.index') }}">
        <span class="icon-holder">
            <i class="c-gray-500 ti-marker-alt"></i>
        </span>
        <span class="title">Feedback Question</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.feedback-forms') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.feedback-forms.index') }}">
        <span class="icon-holder">
            <i class="c-yellow-500 ti-thought"></i>
        </span>
        <span class="title">Feedback Forms</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.feedback-sessions') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.feedback-sessions.index') }}">
        <span class="icon-holder">
            <i class="c-orange-500 ti-pencil-alt"></i>
        </span>
        <span class="title">Feedback Sessions</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.users') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.users.index') }}">
        <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
        </span>
        <span class="title">Users</span>
    </a>
</li>
@can('viewAny', Setting::class)
<li class="nav-item">
    <a class="sidebar-link {{ starts_with($route, ADMIN . '.settings') ? 'active' : '' }}"
        href="{{ route(ADMIN . '.settings.index') }}">
        <span class="icon-holder">
            <i class="c-black-500 ti-settings"></i>
        </span>
        <span class="title">Settings</span>
    </a>
</li>
@endcan