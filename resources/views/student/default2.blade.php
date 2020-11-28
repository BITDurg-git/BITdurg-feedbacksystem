<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body class="app">

  {{-- <div class="col-md-12 col-lg-12">
    <img style="margin:auto;display:block;" src="/images/bit7.png" alt="">
  </div> --}}


    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("/images/bg3.png")'>
      </div>
      <div class="col-12 col-md-5 peer h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <div class="row">
                <div class="col-md-12 col-lg-12">
                        @include('student.partials.topbar')
                    </div>
                    <div class="col-md-12 col-lg-12">
                        @include('student.partials.messages') 
                        @yield('content')
                        <footer class="bdT ta-c fl-c p-30 lh-0 fsz-sm c-grey-600">
                          <span>Copyright © 2019 Designed by
                              <a href="https://www.facebook.com/shubham.verma.186590" target='_blank' title="ThankYou!">Shubham Kumar</a>.</span><br>
                      </footer>
                      
                    </div>
        </div>
      </div>
      
    </div>
    
  
</body>
</html>
