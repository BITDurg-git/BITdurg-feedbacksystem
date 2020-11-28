<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet"> 
	
	@yield('css')

</head>

<body class="app">

    @include('student.partials.spinner')


        <!-- #Main ============================ -->
            <!-- ### $Topbar ### -->    

            <!-- ### $App Screen Content ### -->
            <main class='pT-20 bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">
						@include('student.partials.messages') 
						@yield('content')
                    </div>
                </div>
            </main>
    <script src="{{ mix('/js/app.js') }}"></script>

    @yield('js')

</body>

</html>
