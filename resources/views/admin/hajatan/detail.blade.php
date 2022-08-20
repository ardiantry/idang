 @extends('admin.layout.app')
 @section('content') 

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li> 
				<li class="breadcrumb-item">
					<a href="{{url('anggota/kondangan')}}">List Kondangan</a>
				</li> 
				<li class="breadcrumb-item active">{{@$tb->nama_kondangan}}</li>
			</ol>
		</div>
		<h4 class="page-title">Data Kondangan</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		 		<div class="row"> 
					 <table class="table">
					 	<tr>
					 		<td>Nama Acara</td>
					 		<td>:</td>
					 		<td>{{@$tb->nama_kondangan}}</td> 
					 	</tr>
					 	<tr>
					 		<td>Alamat</td>
					 		<td>:</td>
					 		<td>{{@$tb->alamat}}</td> 
					 	</tr>
					 	<tr>
					 		<td>Status</td>
					 		<td>:</td>
					 		<td>{{@$tb->status}}</td> 
					 	</tr>
					 	<tr>
					 		<td>Jumlah Tamu</td>
					 		<td>:</td>
					 		<td>{{@$tb->Jumltb_tamu}} <a href="{{route('adminlisttamu',@$tb->id)}}">lihat Jumlah Tamu</a></td> 
					 	</tr>
					 	<tr>
					 		<td>Foto</td>
					 		<td>:</td>
					 		<td><img src="{{@$tb->foto}}" width="100px"></td> 
					 	</tr>
					 	<tr>
					 		<td>Tanggal Mulai</td>
					 		<td>:</td>
					 		<td>{{@$tb->tgl_mulai}}</td> 
					 	</tr>
					 	<tr>
					 		<td>Tanggal Selesai</td>
					 		<td>:</td>
					 		<td>{{@$tb->tgl_selesai}}</td> 
					 	</tr>
					 	<tr>
					 		<td>Lama Acara</td>
					 		<td>:</td>
					 		<td>{{@$tb->lama_acara}}</td> 
					 	</tr>
					 </table>
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