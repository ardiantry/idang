 @extends('admin.layout.app')
 @section('content') 

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('admin')}}">Home</a>
				</li> 
		 
				<li class="breadcrumb-item">
					<a href="{{url('admin/undangan')}}">{{@$kondangan->nama_kondangan}}</a>
				</li> 
				 
				<li class="breadcrumb-item active">Tamu</li>
			</ol>
		</div>
		<h4 class="page-title">Data Tamu</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		 		<div class="row">
					<div class="col-md-4">
						<button class="btn btn-primary btn-sm">Print PDF</button>
					</div>
					<div class="col-md-4"> 
					</div>
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" name="" class="form-control">
							<span class="input-group-append">
								<button class="btn btn-primary btn-sm">Cari</button> 
							</span>
						</div>
					</div>  
					<div class="table-responsive"> 
						<table class="table">
							<tr>
								<th>Nama Tamu</th> 
								<th>No Telp</th>  
								<th>Alamat</th>  
							</tr>
							 @foreach($dt_tamu as $key)
							 <tr>
								<td>{{$key->nama}}</td> 
								<td>{{$key->nomor_hp}}</td>  
								<td>{{$key->alamat}}</td>  

							</tr>
							 @endforeach
						</table>
					</div>
				</div> 	
			</div>
		</div>
	</div>
 </div>
  
<script type="text/javascript">
	$(document).ready(function()
	{   

	});
</script>
 @endsection