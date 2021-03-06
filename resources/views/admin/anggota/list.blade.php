 @extends('admin.layout.app')
 @section('content')
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('admin')}}">Home</a>
				</li>  
				<li class="breadcrumb-item active">Anggota</li>
			</ol>
		</div>
		<h4 class="page-title">Data Anggota</h4></div> 
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
				</div>
					<div class="table-responsive"> 
						<table class="table">
							<tr>
								<th>Nama</th> 
								<th>Email</th>  
							</tr>
							 @foreach($data_list as $key)
							 <tr>
								<td>{{$key->name}}</td> 
								<td>{{$key->email}}</td>   
							</tr>
							 @endforeach
						</table>
					</div>
					{{$data_list->links()}}
				</div> 	
			</div>
		</div>
	</div>
 </div> 
 @endsection