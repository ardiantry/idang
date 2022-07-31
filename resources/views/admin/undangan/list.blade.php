 @extends('admin.layout.app')
 @section('content') 

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li> 
				<li class="breadcrumb-item active">Data Undangan</li>
			</ol>
		</div>
		<h4 class="page-title">Data Undangan</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
						<div class="col-md-12">
			 				<div class="row">  
							<div class="col-md-4"> 
								<button class="btn btn-primary btn-sm" id="pdf">Print PDF</button>
							</div>
							<div class="col-md-4"> 
							</div>
							<div class="col-md-4">
								<div class="input-group">
									<input type="text" name="cari" class="form-control">
									<span class="input-group-append">
										<button class="btn btn-primary btn-sm" id="caridat">Cari</button> 
									</span>
								</div>
							</div>   
							</div>
							<div class="table-responsive" id="getdata"> 
								<table class="table">
									<tr>
										<th>Judul Undangan</th> 
										<th>Jumlah Tamu</th>
										<th>Nama Pemilik</th>
										<th>Status</th>
										<th>Tanggal mulai</th> 
										<th>Tanggal selesai</th> 
										<th>Jam mulai</th> 
										<th>lama Acara</th> 
										<th class="hide_pdf">Ubah Status</th>  
									</tr>
									<tbody id="loadtb"> 
									</tbody>
								</table>
							</div>
						
				</div> 	
			</div>
		</div>
	</div>
 </div>
 <!-- Modal -->
 <div id="ModalForm" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title align-self-center mt-0">Isikan Data Undangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <div class="ms-alert"></div>
                <form id="prosesSimpan" name="prosesSimpan">
                    <div class="form-group">
                        <label>Nama Undangan</label>
                        <textarea class="form-control" disabled="disabled" name="nama_kondangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status Aktif</label>
                       	<select class="form-control" name="aktif">
                       	<option value="aktif">Setujui</option>
                       	<option value="non_aktif">Tidak Di setujui</option>
                       </select>
                    </div>
                     
                     <div class="form-group">
                        <label>Foto Undangan</label> 
                       	 <div class="image_foto"></div>
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

			$('body').delegate('#AddKondang','click',function(e)
			{ 
				e.preventDefault();  
				window.id_edit=undefined;
				$('.ms-alert').empty(); 
				$('textarea[name="nama_kondangan"]').empty();
				$('textarea[name="alamat"]').empty(); 
				$('select[name="aktif"] option').removeAttr('selected');
				$('input[name="tgl_mulai"]').val('');
				$('input[name="tgl_selesai"]').val('');
				$('select[name="jam_mulai"] option').removeAttr('selected');
				$('select[name="menit_mulai"] option').removeAttr('selected');
				$('select[name="jam_selesai"] option').removeAttr('selected');
				$('select[name="menit_selesai"] option').removeAttr('selected'); 
				$('.image_foto').empty();

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
				if(window.id_edit!=undefined)
				{
					Form_item.append('id_edit', window.id_edit);   
				}
				fetch('{{route('simpanundangan')}}', { method: 'POST',body:Form_item}).then(res => res.json()).then(data => 
				    { 
				    	this_.find('button[type="submit"]').html('Simpan');
						this_.find('button[type="submit"]').removeAttr('disabled');
						var status=data.error?'danger':'success';
						$('.ms-alert').html('<div class="alert alert-'+status+'"><ul>'+data.alert+'</ul></div>');
				    	 loaddt();
				    });
			});	 
			loaddt();
			function loaddt()
			{

				const Form_dt  = new FormData();
				if(window.cari!=undefined)
				{

				Form_dt.append('cari', window.cari);  
				}
				Form_dt.append('_token', '{{csrf_token()}}');  
				fetch('{{route('loadundangan')}}', { method: 'POST',body:Form_dt}).then(res => res.json()).then(data => 
				    { 
				    	var list_=``;


				    	 for(let list of data.tb.data)
				    	 {
				    	 	var name_=list.name?list.name:'-';
				    	 	var status=list.status=='aktif'?'<span class="badge badge-success">di setujui</span':'<span class="badge badge-danger">tidak di setujui</span>';
				    	 	window['kondangan_'+list.id]=list;
										list_+=`<tr>
										<th>`+list.nama_kondangan+`</th> 
										<th>`+list.Jumltb_tamu+`</th>
										<th>`+name_+`</th>
										<th>`+status+`</th> 
										<th>`+list.tgl_mulai+`</th>
										<th>`+list.tgl_selesai+`</th> 
										<th>`+list.jam_menit_mulai+`</th> 
										<th>`+list.lama_acara+`</th> 
										<th data-id="`+list.id+`" class="text-center hide_pdf" >
										 
										<a class="btn btn-success btn-sm edit" title="Ubahstatus"><i class="fa fa-pencil"></i></a> 
										</tr>`;
				    	 }
				    	 $('#loadtb').html(list_);
				    	 
				    });
			} 

			$('body').delegate('.edit','click',function(e)
			{ 
				e.preventDefault();  
				$('.ms-alert').empty(); 

				window.id_edit=$(this).closest('th').data('id');
				$('textarea[name="nama_kondangan"]').html(window['kondangan_'+window.id_edit].nama_kondangan);
				$('textarea[name="alamat"]').html(window['kondangan_'+window.id_edit].alamat);
				$('select[name="aktif"] option[value="'+window['kondangan_'+window.id_edit].status+'"]').attr('selected','selected');

				$('select[name="id_anggota"] option[value="'+window['kondangan_'+window.id_edit].id_anggota+'"]').attr('selected','selected');

				$('input[name="tgl_mulai"]').val(window['kondangan_'+window.id_edit].tgl_mulai);
				$('input[name="tgl_selesai"]').val(window['kondangan_'+window.id_edit].tgl_selesai);
				$('select[name="jam_mulai"] option[value="'+window['kondangan_'+window.id_edit].jam_mulai+'"]').attr('selected','selected');
				$('select[name="menit_mulai"] option[value="'+window['kondangan_'+window.id_edit].menit_mulai+'"]').attr('selected','selected');
				$('select[name="jam_selesai"] option[value="'+window['kondangan_'+window.id_edit].jam_selesai+'"]').attr('selected','selected');
				$('select[name="menit_selesai"] option[value="'+window['kondangan_'+window.id_edit].menit_selesai+'"]').attr('selected','selected'); 
				$('.image_foto').html('<img src="'+window['kondangan_'+window.id_edit].foto+'" width="100%">');
				$('#ModalForm').modal({ backdrop: 'static',keyboard: false});  
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
				Form_dthps.append('id_hapus', $(this).closest('th').data('id'));   
				fetch('{{route('hapusundangan')}}', { method: 'POST',body:Form_dthps}).then(res => res.json()).then(data => 
				{ 
					loaddt();
				});
			});

			$('body').delegate('#caridat','click',function(e)
			{ 
				e.preventDefault();  
				 window.cari=$('input[name="cari"]').val();
				 loaddt();
				
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