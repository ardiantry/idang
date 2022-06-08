<!DOCTYPE html>
	<html lang="en">
 <head>
	<meta charset="utf-8">
	<title>{{@Auth::user()->name}} | Kondangan di desa Sudimampir </title>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta content="Kondangan di desa Sudimampir TA idang" name="description">
	<meta content="idang" name="author">
	<link rel="shortcut icon" href="{{asset('asset/images/favicon.ico')}}">
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="{{asset('asset/plugins/morris/morris.css')}}">
	<link href="{{asset('asset/plugins/metro/MetroJs.min.css')}}" rel="stylesheet">
	<!-- App css -->
	<link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="{{asset('asset/css/icons.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('asset/css/style.css')}}" rel="stylesheet" type="text/css">
	<script src="{{asset('asset/js/jquery.min.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
		<footer class="footer text-center text-sm-left">&copy; 2018 Indramayu 
			<span class="text-muted d-none d-sm-inline-block float-right">Crafted with
			 <i class="mdi mdi-heart text-danger"></i> by Idang
			</span>
		</footer>
	</div>
</div> 

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
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