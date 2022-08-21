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
						<button class="btn btn-primary btn-sm" id="pdf">Print PDF</button>
					</div>
					<div class="col-md-4"> 
					</div>
					<div class="col-md-4">
						<form action="{{url()->current()}}" method="get"> 
						<div class="input-group">
							<input type="text" name="cari" value="{{@$app->request->input('cari')}}" class="form-control">
							<span class="input-group-append">
								<button class="btn btn-primary btn-sm">Cari</button> 
							</span>
						</div>
					</form>
					</div> 
				</div>
					<div class="table-responsive"> 
						<div id="getdata">
						<table class="table">
							<tr>
								<th>Nama</th> 
								<th>Email</th>  
								{{-- <th>NIK</th>   --}}

								<th>Hapus Anggota</th>  

							</tr>
							 @foreach($data_list as $key)
							 <tr>
								<td>{{$key->name}}</td> 
								<td>{{$key->email}}</td> 
								{{-- <td>{{$key->nik}}</td>    --}}

								<th><a href="{{route('hapusanggota',$key->id)}}" class="hapus btn btn-danger"> Hapus</a></th>  

							</tr>
							 @endforeach
						</table>
						</div>
					</div>
					{{$data_list->links()}}
				</div> 	
			</div>
		</div>
	</div>
 </div> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script type="text/javascript">
 	$(document).ready(function(e) 
 	{
 		$('body').delegate('#pdf','click',function(e)
			{
				e.preventDefault(); 
				$('.hide_pdf').remove();
				var element = document.getElementById('getdata'); 
				html2pdf(element);
				setTimeout(function(){
					window.location.reload();
				},1000);


			});
 		$('body').delegate('.hapus','click',function(e)
			{
				e.preventDefault(); 
				 if(!confirm('Yakin menghapus data?'))
				 {
				 	return;
				 }
				 window.location.href=$(this).attr('href');

			});
 		
 	 
 	});
 </script>
 @endsection