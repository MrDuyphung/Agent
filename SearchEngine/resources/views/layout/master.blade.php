<!DOCTYPE html>
<html>
<head>
  <title>Search Agent</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

  <!-- plugin css -->
  <link rel="stylesheet" href="{{asset('assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
  <!-- end plugin css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
{{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">--}}
  <!-- common css -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
  <!-- end common css -->


</head>
<body data-base-url="{{url('/')}}">

{{--<iframe width="560" height="315" src="https://www.youtube.com/embed/qwM23_kF4v4" frameborder="0" allowfullscreen></iframe>--}}

  <div class="container-scroller" id="app">
{{--    @include('layout.header')--}}
    <div class="container-fluid page-body-wrapper">
      @include('layout.sidebar')

{{--      <div class="main-panel">--}}
        <div class="content-wrapper">
          @yield('content')
        </div>
      </div>
    </div>
  </div>




  <script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
  <!-- end base js -->

  <!-- plugin js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <!-- end plugin js -->

  <!-- common js -->
<script src="{{asset('js/index.js')}}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}
{{--  <script src="{{ asset('js/custom.js') }}"></script>--}}



</body>

</html>
