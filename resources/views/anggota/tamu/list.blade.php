 @extends('anggota.layout.app')
 @section('content') 

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
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
						<a class="btn btn-success btn-sm" id="AddKondang">Tambah Tamu</a>
						<button class="btn btn-primary btn-sm" id="pdf">Print PDF</button>
					</div>
					<div class="col-md-4"> 
					</div>
					<div class="col-md-4">

					<form action="{{url()->current()}}" method="get"> 
						<div class="input-group">
							<input type="text" name="cari" class="form-control">
							<span class="input-group-append">
								<button class="btn btn-primary btn-sm">Cari</button> 
							</span>
						</div>
					</form>
					</div> 
				</div>
					
					<div class="table-responsive"  id="getdata"> 
						<table class="table">
							<tr>
								<th>Nama Tamu</th>
								<th>Nama Undangan</th>
								<th>No Telp</th>  
								<th>Alamat</th> 
								<!-- <th>Jenis Kelamin</th>  -->
								<th class="hide_pdf">Aksi</th>
							</tr>
							 @foreach($dt_tamu as $key)
							 @php
							 $jenis_kelamin=$key->jenis_kelamin=='l'?'laki-laki':'perempuan';
							 @endphp
							 <tr>
								{{-- <td>{{$key->nama_kondangan}}</td>  --}}
								<td>{{$key->nama}}</td> 
								<td>{{$key->nomor_hp}}</td> 
								<td>{{$key->alamat}}</td> 
							<!-- 	<th>{{$jenis_kelamin}}</th> -->  
								<td class="hide_pdf">
									<a class="btn btn-warning btn-sm Edit" data-id="{{$key->id}}">Edit</a> 
									<a class="btn btn-danger btn-sm hapus" data-id="{{$key->id}}">Hapus</a>
								</td> 

							</tr>
							 @endforeach
						</table> 
				</div> 	
						{{$dt_tamu->links()}}
			</div>
		</div>
	</div>
 </div>
 <!-- Modal -->
 <div id="ModalForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-self-center mt-0">Isikan Data Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <div class="ms-alert"></div>
                <form id="prosesSimpan" name="prosesSimpan">
					 
                    <div class="form-group">
                        <label>Nama Tamu</label>
                        <input type="text" name="nama" minlength="2" class="form-control" required="required">
                    </div>
					<div class="form-group">
						<label>Nama tamu</label>
						<select class="form-control" name="id_kondangan">
							<option>-Pilih Undangan--</option>
							@php
							$tb_kondangan=DB::table('tb_kondangan')->where('id_anggota',@Auth::user()->id)->get();
							@endphp
							@foreach($tb_kondangan as $key)
							<option value="{{ $key->id}}">{{$key->nama_kondangan}}</option>
							@endforeach
						</select>
					</div>
					
                     <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" name="nomor_hp" minlength="2" maxlength="15" class="form-control" required="required" >
                    </div>
                  <!--   <div class="form-group">
                        <label>Jenis Kelamin</label>
                       <select name="jenis_kelamin" class="form-control">
	                       	<option value="l">Laki-laki</option>
	                       	<option value="p">Perempuan</option> 
                       </select>
                    </div> -->
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" minlength="2" required="required"></textarea>
                    </div>                    
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
	$(document).ready(function()
	{ 


		@foreach($dt_tamu as $key)
		window['edit_{{$key->id}}']= {!!json_encode($key)!!};
		@endforeach

			$('body').delegate('#AddKondang','click',function(e)
			{ 
				e.preventDefault();  
				window.id_edit=undefined;
				$('.ms-alert').empty(); 
				$('input[name="nomor_hp"]').val('');
				$('select[name="jenis_kelamin"]').find('option').removeAttr('selected'); 
				$('textarea[name="nama"]').empty(); 
				$('textarea[name="alamat"]').empty();  
				$('#ModalForm').modal({ backdrop: 'static',keyboard: false});  
			});
			$('body').delegate('#prosesSimpan','submit',function(e)
			{
				e.preventDefault();
				var this_=$(this);
				$('.ms-alert').empty();
				this_.find('button[type="submit"]').html('loading...');
				this_.find('button[type="submit"]').attr('disabled','disabled');

				const formsimpan  = document.forms.namedItem('prosesSimpan'); 
				const Form_item  = new FormData(formsimpan);
				Form_item.append('_token', '{{csrf_token()}}');  
				@if(@$kondangan->id)
				Form_item.append('id_undangan','{{@$kondangan->id}}');   
				@endif
				if(window.id_edit!=undefined)
				{
					Form_item.append('id_edit', window.id_edit);   
				}
				fetch('{{route('simpantamu')}}', { method: 'POST',body:Form_item}).then(res => res.json()).then(data => 
				    { 
				    	this_.find('button[type="submit"]').html('Simpan');
						this_.find('button[type="submit"]').removeAttr('disabled');
						var status=data.error?'danger':'success';
						$('.ms-alert').html('<div class="alert alert-'+status+'"><ul>'+data.alert+'</ul></div>');
				     	window.location.reload();
				    });
			});	  

			$('body').delegate('.hapus','click',function(e)
			{ 
				e.preventDefault();   
				 if(!confirm('yakin akan menghapus data ini?'))
				 {
				 	return;
				 }
				const Form_dthps  = new FormData();
				Form_dthps.append('_token', '{{csrf_token()}}');  
				Form_dthps.append('id_hapus', $(this).data('id'));   
				fetch('{{route('hapustamu')}}', { method: 'POST',body:Form_dthps}).then(res => res.json()).then(data => 
				{ 
						window.location.reload(); 
				});
			});

			$('body').delegate('.Edit','click',function(e)
			{ 
				e.preventDefault();   
				$('#ModalForm').modal({ backdrop: 'static',keyboard: false});  

				var dat_edit=window['edit_'+$(this).data('id')];
				window.id_edit=$(this).data('id');
				$('input[name="nama"]').val(dat_edit.nama);
				$('input[name="nomor_hp"]').val(dat_edit.nomor_hp); 
				$('textarea[name="alamat"]').html(dat_edit.alamat);  
				$('select[name="jenis_kelamin"]').find('option[value="'+dat_edit.jenis_kelamin+'"]').attr('selected','selected');   

				 
			});
			
 
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

	});
</script>
 @endsection