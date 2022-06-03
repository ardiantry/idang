 @extends('admin.layout.app')
 @section('content')
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('admin')}}">Home</a>
				</li>  
				<li class="breadcrumb-item active">Kondangan</li>
			</ol>
		</div>
		<h4 class="page-title">Data Kondangan</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">   
					<div class="table-responsive"> 
						<table class="table">
							<tr>
								<th>Nama Kondangan</th> 
								<th>Tempat Acara</th> 
								<th>Tanggal mulai</th>  
								<th>Tanggal selesai</th>
								<th>Jumlah Tamu</th>
								<th>Lama Acara</th> 
							</tr>
							 @foreach($data_list as $key)
							 <tr>
								<td>{{$key->nama_kondangan}}</td> 
								<td>{{$key->alamat}}</td>  
								<td>{{$key->tgl_mulai}}</td>   
								<td>{{$key->tgl_selesai}}</td>  
								<td>{{$key->Jumltb_tamu}}</td> 
								<td>{{$key->lama_acara}}</td>   
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