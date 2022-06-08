 @extends('anggota.layout.app')
 @section('content') 
 <style type="text/css">
 	h3 {
  line-height: 30px;
  font-size: 24px;
  text-transform: capitalize;
}
 </style>
 @php
	$label_satuan=Request::segment(3)!='uang'?'Jumlah Beras':'Nominal';
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
				<li class="breadcrumb-item">Pemasukan Hutang</li>
				<li class="breadcrumb-item active">{{Request::segment(3)}}</li>
			</ol>
		</div>
		<h4 class="page-title">{{Request::segment(3)}}</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<h3>Tambah hutang {{Request::segment(3)}}</h3>
						<form name="tambahhutang" id="tambahhutang">
							<div class="ms-alert"></div>
							<div class="form-group">
								<label>Nama Undangan</label>
								<select class="form-control" name="id_undangan">
									<option>-Pilih undangan--</option>

									@php
									$dbkondangan=DB::table('tb_kondangan')->get();
									@endphp
									@foreach($dbkondangan as $key)
									<option value="{{ $key->id}}">{{$key->nama_kondangan}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Nama tamu</label>
								<select class="form-control" name="id_tamu">
									<option>-Pilih tamu--</option>
									@php
									$tb_tamu=DB::table('tb_tamu')->where('id_user',Auth::user()->id)->get();
									@endphp
									@foreach($tb_tamu as $key)
									<option value="{{ $key->id}}">{{$key->nama}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>{{$label_satuan}}</label>
								 <input type="text" name="satuan" placeholder="{{$nominal_satuan}}" class="form-control">
							</div>
							<button type="submit" class="btn btn-success btn-sm">Simpan</button>
							<span id="yakinedit"></span>
						</form>
					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
							<table class="table">
								<tr><td>Total Buwuhan</td><td>:</td><td>{{$jlh}}</td></tr>
								<tr><td>Jumlah Tamu</td><td>:</td><td>{{$jlh_tamu}}</td></tr>

							</table>
							</div>
							<div class="col-md-6">
								<button class="btn btn-primary btn-sm">Print PDF</button>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" name="" class="form-control">
									<span class="input-group-append">
									<button class="btn btn-primary btn-sm">Cari</button> 
									</span>
								</div>
							</div> 
						</div>
					
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead> 
									<tr>
										<th>Nama Tamu</th>
										<th>Alamat</th> 
										<th>Undangan</th> 
										<th>{{$label_satuan}}</th>
										<th>Tanggal</th> 
										<th>Aksi</th> 
									</tr>
								</thead>
								@if(count($data_list)==0)
								 
									<tr>
										<th colspan="6" class="text-center">Data kosong</th>
									 
									</tr>
								 @else
								@foreach($data_list as $key)
								<tbody>
									<tr>
										<td>{{$key->nama}}</td>
										<td>{{$key->alamat}}</td> 
										<td>{{$key->nama_kondangan}}</td> 
										<td>{{$label_satuan}}</td>
										<td>{{$key->created_at}}</td>
										<td>
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
<script type="text/javascript">
$(document).ready(function()
{ 
	@foreach($data_list as $key)
	window['id_'+'{{$key->id}}']={!!json_encode($key)!!};
	@endforeach
		$('body').delegate('#tambahhutang','submit',function(e)
			{
				e.preventDefault();
				var this_=$(this);
				$('.ms-alert').empty();
				this_.find('button[type="submit"]').html('loading...');
				this_.find('button[type="submit"]').attr('disabled','disabled');

				const formsimpan  = document.forms.namedItem('tambahhutang'); 
				const Form_item  = new FormData(formsimpan);
				Form_item.append('_token', '{{csrf_token()}}');
				Form_item.append('jenis_barang', '{{Request::segment(3)}}'); 
				Form_item.append('jenis_magang', 'pemasukan hutang');    
				if(window.id_edit!=undefined)
				{
					Form_item.append('id_edit', window.id_edit);   
				}
				fetch('{{route('simpanpemasukan')}}', { method: 'POST',body:Form_item}).then(res => res.json()).then(data => 
				    {  
				    	if(data.error)
				    	{
				    		$('.ms-alert').html('<div class="alert alert-alert">'+data.alert+'</div>');
				    		return
				    	}
				     	window.location.reload();
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
				$('select[name="id_undangan"] option[value="'+data_edit.id_undangan+'"]').attr('selected','selected');
				$('select[name="id_tamu"] option[value="'+data_edit.id_tamu+'"]').attr('selected','selected');
				$('input[name="satuan"]').val(data_edit.jumlah);

			});
			$('body').delegate('#yakinedit button[type="button"]','click',function(e)
			{
				e.preventDefault();
				$('#yakinedit').empty(); 
				window.id_edit=undefined; 
				$('button[type="submit"]').html('Simpan'); 
				$('select[name="id_undangan"] option').removeAttr('selected');
				$('select[name="id_tamu"] option').removeAttr('selected');
				
				$('input[name="satuan"]').val('');

			});
});
</script>
 @endsection