<!DOCTYPE html>
	<html lang="en">
 <head>
	<meta charset="utf-8">
	<title>{{@Auth::user()->name}} | Aplikasi Kondangan Sudimampir </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta content="Kondangan di desa Sudimampir " name="description">
	<meta content="idang" name="author">
	<link rel="shortcut icon" href="{{asset('asset/images/favicon.ico')}}">
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="{{asset('asset/plugins/morris/morris.css')}}">
	<link href="{{asset('asset/plugins/metro/MetroJs.min.css')}}" rel="stylesheet">
	<!-- App css -->
	<link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/bootstrap-new.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/style.css')}}" rel="stylesheet" type="text/css">
	<script src="{{asset('asset/js/jquery.min.js')}}"></script>
	<script src="{{asset('asset/js/jquery-3.2.1.slim.min.js')}}"></script>
</head>
<body>
	@include('anggota.layout.tob')
	<div class="page-wrapper">
		@include('anggota.layout.side')
		<div class="page-content">
			<div class="container-fluid">
			 @yield('content')
			</div>
		</div>
		<footer class="footer text-center text-sm-left">&copy; 2022 SUDIMMAPIR
			{{-- <span class="text-muted d-none d-sm-inline-block float-right">Crafted with
			 <i class="mdi mdi-heart text-danger"></i> by Idang
			</span> --}}
		</footer>
	</div>
</div> 

<script src="{{asset('asset/js/popper.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap-new.min.js')}}" ></script> 
<script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('asset/js/metisMenu.min.js')}}"></script>
<script src="{{asset('asset/js/waves.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.slimscroll.min.js')}}"></script>
<!--Plugins-->
<script src="{{asset('asset/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('asset/pages/jquery.dashboard.init.js')}}"></script>
<!-- App js -->
<script src="{{asset('asset/js/app.js')}}"></script>


</body> </html>