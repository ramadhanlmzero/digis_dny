<!DOCTYPE html>
<html>
    
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>DNY Hijab Sport WebGIS</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('line-awesome/css/line-awesome.min.css') }}">
    @yield('css')
</head>

<body>
    @auth
	<div class="wrapper">
		<div class="main-header">
			@include('layouts.navbar')
        </div>
        <div class="sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <h4 class="page-title">@yield('title')</h4>
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    @include('layouts.footer')			
                </div>
            </footer>
        </div>
	</div>
    @endauth
    @guest
            <div class="content">
                <div class="container-fluid">
                    {{-- <h4 class="page-title">@yield('title')</h4> --}}
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    @include('layouts.footer')			
                </div>
            </footer>
    @endguest
</body>

<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/ready.min.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{asset('assets/js/plugin/sweetalert2.all.js')}}"></script>
@include('sweet::alert')
@yield('js')

</html>