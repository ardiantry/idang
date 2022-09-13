@extends('anggota.layout.app')
@section('content') 
 <style type="text/css">
 	h3 {
  line-height: 30px;
  font-size: 24px;
  text-transform: capitalize;
}
.border {
  margin: 10px 0px;
}
 </style>
 @php
	$label_satuan=Request::segment(3)!='uang'?'Jumlah':'Nominal';
	$nominal_satuan=Request::segment(3)!='uang'?'kg':'Nominal';
	$jlh=Request::segment(3)!='uang'?$jlh.'kg':'Rp '.number_format($jlh,0,'.','.').',-';
 @endphp
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li>  
				<li class="breadcrumb-item">Pemasukan Magang</li>
				<li class="breadcrumb-item active">{{Request::segment(3)}}</li>
			</ol>
		</div>
		<h4 class="page-title">Data Pemasukan Magang {{Request::segment(3)}}</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">

						<h4>Pemasukan magang {{Request::segment(3)}}</h4>
						<form name="tambahmagang" id="tambahmagang">
							<div class="ms-alert"></div>
							 
							<div class="form-group">
								<label>Nama tamu</label>
								<select class="form-control" name="id_tamu">
									<option>-Pilih tamu--</option>
									@php
									$tb_tamu=DB::table('tb_tamu')->where('id_user',@Auth::user()->id)->get();
									$arry_alamat=array();
									@endphp
									@foreach($tb_tamu as $key)
									@php
									$arry_alamat[$key->id]=@$key->alamat;
									@endphp
									<option value="{{ $key->id}}">{{$key->nama}}</option>
									@endforeach
								</select>
							</div>
							<div id="alamat">
								
							</div>
							<div class="form-group">
								<label>Tanggal</label>
								 <input type="date" name="created_at"  placeholder="" class="form-control">
							</div>
							<div class="form-group">
								<label>{{$label_satuan}}</label>
								 <input type="number" name="satuan" placeholder="{{$nominal_satuan}}" class="form-control">
							</div>
							<div class="form-group">
								<label>Status</label>
								 <select name="status" placeholder="Status" class="form-control">
								 	<option value="belumbayar">Belum Bayar</option>
									<option value="sudahbayar">Sudah Bayar</option>
								 	

								 </select>
							</div>
							<button type="submit" class="btn btn-success btn-sm">Simpan</button>
							<span id="yakinedit"></span>
						</form>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="border">
							<table class="table">
								<tr><td>Total Buwuhan</td><td>:</td><td>{{$jlh}}</td></tr>
								<tr><td>Jumlah Tamu</td><td>:</td><td>{{$jlh_tamu}}</td></tr>

							</table>
							</div>
							</div>
							<div class="col-md-6">
								<button class="btn btn-primary btn-sm" id="pdf">Download PDF</button>
								<a class="btn btn-warning btn-sm" href="{{route('anggotatamu')}}">Tambah Tamu</a>
								
							</div>
							<div class="col-md-6">
								<form action="{{url()->current()}}" method="get"> 
								<div class="input-group">
									@php
									$kondangan = DB::table('tb_kondangan')->where('status','aktif')->where('id_anggota',Auth::user()->id)->get();
									@endphp
									<select name="kondangan" class="form-control">
										<option value="">Pilih Hajatan</option>
										@foreach($kondangan as $key)
										@php
										@$selected_=@$app->request->input('kondangan')==@$key->id?'selected="selected"':'';
										@endphp 
											<option value="{{@$key->id}}" {{$selected_}}>{{@$key->nama_kondangan}}</option>
										@endforeach		
									</select>
									<input type="text" name="cari" value="{{@$app->request->input('cari')}}" class="form-control">
									<span class="input-group-append">
									<button class="btn btn-primary btn-sm">Cari</button> 
									</span>
								</div>
								</form>
							</div> 
						</div>
					
						<div class="table-responsive" id="getdata">

							<table class="table table-bordered">
								<thead> 
									<tr>
										<th>NO</th>
										<th>Nama</th>
										<th>Alamat</th>  
										<th>Nama Hajatan</th>
										<th>{{$label_satuan}}</th>
										<th>Status</th> 
										<th>Tanggal</th> 
										<th class="hide_pdf">Aksi</th> 
									</tr>
								</thead>
								@if(count($data_list)==0)
								 
									<tr>
										<th colspan="8" class="text-center">Data kosong</th>
									 
									</tr>
								 @else
								@foreach($data_list as $key)
								@php
								$key->jumlah2=Request::segment(3)!='uang'?$key->jumlah.' kg':'Rp '.number_format($key->jumlah,0,'.','.').',-'; 
								$status_=@$key->status=='sudahbayar'?'Sudah Bayar':'Belum di bayar'; 
								@endphp
								<tbody>
									<tr>
										<td scope="row">{{$loop->iteration}}</td>
										<td>{{$key->nama}}</td>
										<td>{{$key->alamat}}</td>  
										<td>{{$key->nama_kondangan}}</td>  
										<td>{{$key->jumlah2}}</td> 
										<td>{{$status_}}</td>  
										<td>{{Carbon\Carbon::parse($key->created_at)->format('d-m-Y')}}</td> 
 
										<td class="hide_pdf">
											<a class="btn btn-warning btn-sm edit" title="edit" data-id="{{$key->id}}"><i class="fa fa-pencil"></i></a>
											<a class="btn btn-danger btn-sm hapus" title="hapus" data-id="{{$key->id}}"><i class="fa fa-trash"></i></a>
										</td> 

									</tr>
								</tbody>
								@endforeach
								@endif
							</table>

							{{@$data_list->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$(document).ready(function()
{ 
	$('select[name="id_tamu"]').select2();
	@foreach($data_list as $key)
	@php
	$key->created_at=Carbon\Carbon::parse($key->created_at)->format('Y-m-d');
	@endphp
	window['id_'+'{{$key->id}}']={!!json_encode($key)!!};
	@endforeach

	$('body').delegate('select[name="id_tamu"]','change',function(e)
	{
		e.preventDefault();
		getalamat($(this).val());
	});
	var alamat_={!!json_encode($arry_alamat)!!}; 
	function getalamat(id_tamu=undefined)
	{
		$('#alamat').empty();
		if(id_tamu==undefined)
		{
			return;
		}
		var alamat=alamat_[id_tamu]; 
		$('#alamat').html('<div  class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat">'+alamat+'</textarea></div>');
	}

		$('body').delegate('#tambahmagang','submit',function(e)
			{
				e.preventDefault();
				var this_=$(this);
				$('.ms-alert').empty();
				this_.find('button[type="submit"]').html('loading...');
				this_.find('button[type="submit"]').attr('disabled','disabled'); 
				const formsimpan  = document.forms.namedItem('tambahmagang'); 
				const Form_item  = new FormData(formsimpan);
				Form_item.append('_token', '{{csrf_token()}}');
				Form_item.append('jenis_barang', '{{Request::segment(3)}}'); 
				Form_item.append('jenis_magang', 'pemasukan magang');    
				if(window.id_edit!=undefined)
				{
					Form_item.append('id_edit', window.id_edit);   
				}
				fetch('{{route('simpanpemasukan')}}', { method: 'POST',body:Form_item}).then(res => res.json()).then(data => 
				    {  

				    	if(data.error)
				    	{
				    		$('.ms-alert').html('<div class="alert alert-danger">'+data.alert+'</div>');
				    		return
				    	}
				    	else
				    	{
							$('.ms-alert').html('<div class="alert alert-success">Data Berhasil Disimpan</div>');
				    		setTimeout(function(){window.location.reload();},3000);				    	
				    	}
				    });
			});	
			$('body').delegate('.edit','click',function(e)
			{
				e.preventDefault();
				$('#yakinedit').empty(); 
				window.id_edit=$(this).data('id');
				var data_edit=window['id_'+$(this).data('id')];
				$('#yakinedit').html('<button type="button" class="btn btn-danger btn-sm">Batal</button>');
				$('button[type="submit"]').html('Edit'); 

				$('select[name="id_tamu"]').find('option').removeAttr('selected'); 
				$('select[name="id_tamu"]').find('option[value="'+data_edit.id_tamu+'"]').attr('selected','selected');
				$('select[name="id_tamu"]').trigger('change');
				$('select[name="status"]').find('option[value="'+data_edit.status+'"]').attr('selected','selected'); 
				$('input[name="satuan"]').val(data_edit.jumlah);
				$('input[name="created_at"]').val(data_edit.created_at);
				getalamat(data_edit.id_tamu);


			});
		$('body').delegate('#yakinedit button[type="button"]','click',function(e)
			{
				e.preventDefault();
				$('#yakinedit').empty(); 
				window.id_edit=undefined; 
				$('button[type="submit"]').html('Simpan'); 
				// $('select[name="id_undangan"]').val(''); 
				$('select[name="id_tamu"]').find('option').removeAttr('selected');
				$('select[name="id_tamu"]').trigger('change');
				$('select[name="status"]').find('option').removeAttr('selected');

				$('input[name="satuan"]').val('');
				$('input[name="created_at"]').val('');
					getalamat();


			});
		

$('body').delegate('#pdf','click',function(e)
			{
				e.preventDefault();  
				$('.hide_pdf').remove();
				@if(@$app->request->input('kondangan'))
				var nm_kond=$('select[name="kondangan"]').find('option[value="{{@$app->request->input('kondangan')}}"]').html();
<<<<<<< HEAD
				$('#getdata').prepend('<h4 style="text-align:center">'+nm_kond+'</h4>');
=======
				$('#getdata').prepend('<h5>Pemasukan Magang Hajatan '+nm_kond+'</h5>');
>>>>>>> e777b784d61f9aec28b69965ebe4c641c7f2c30e
				@endif
				$('#getdata').prepend('<h4 style="text-align:center">Data Pemasukan Magang {{Request::segment(3)}}</h4>');
				$('#getdata').append('<div>Jumlah total Tamu :{{$jlh_tamu}}, Jumlah Total Buwuhan :{{$jlh}}</div>');
				var element = document.getElementById('getdata'); 
				html2pdf(element);
				setTimeout(function(){
					window.location.reload();
				},1000);

			});

	$('body').delegate('.hapus','click',function(e)
			{
				e.preventDefault();

				if(!confirm('yakin menghapus data?'))
				{	
					return;
				}
				const deleteform  = new FormData();
				deleteform.append('_token', '{{csrf_token()}}');
				deleteform.append('id', $(this).data('id')); 
				fetch('{{route('Hapus_pelayan')}}', { method: 'POST',body:deleteform}).then(res => res.json()).then(data => 
				{  
					
					window.location.reload();
				});
			});

});
</script>
 @endsection 