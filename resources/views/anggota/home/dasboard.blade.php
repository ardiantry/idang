 @extends('anggota.layout.app')
 @section('content')

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li> 
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
		<h4 class="page-title">Dashboard</h4></div> 
	</div>
 
        
        <div class="row">
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-info">
        <div class="inner">
        <h3>{{$tamu}}</h3>
        <p>TAMU</p>
        </div>
        <div class="icon">
        <i class="fa fa-user"></i>
        </div>

        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $masukmagang }}</h3>
        <p>PEMASUKAN MAGANG </p>
        </div>
        <div class="icon">
        <i class="mdi mdi-book-open-variant"></i>
        </div>
       
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{ $masukhutang }}</h3>
        <p>PEMASUKAN HUTANG</p>
        </div>
        <div class="icon">
        <i class="mdi mdi-book-open-page-variant"></i>
        </div>
       
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{ $keluarmagang}}</h3>
        <p>PENGELUARAN MAGANG</p>
        </div>
        <div class="icon">
        <i class="mdi mdi-book-open-page-variant"></i>
        </div>
       
        </div>
        </div>
        
        </div>
    
 
 @endsection