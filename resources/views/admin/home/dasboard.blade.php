 @extends('admin.layout.app')
 @section('content')

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('admin')}}">Home</a>
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
        <h3>{{ $anggota }}</h3>
        <p>ANGGOTA</p>
        </div>
        <div class="icon">
        <i class="fa fa-user"></i>
        </div>

        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $hajatan }}</h3>
        <p>HAJATAN BELUM VALIDASI </p>
        </div>
        <div class="icon">
        <i class="mdi mdi-book-open-variant"></i>
        </div>
       
        </div>
        </div>
        
        <div class="col-lg-3 col-6">
        
        <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{ $hajatanaktif }}</h3>
        <p>HAJATAN SUDAH VALIDASI</p>
        </div>
        <div class="icon">
        <i class="mdi mdi-book-open-page-variant"></i>
        
        </div>

        
       
        </div>
        </div>
        </div>
        
       
    
 
 @endsection
 