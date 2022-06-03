 @extends('anggota.layout.app')
 @section('content') 

 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li> 
				<li class="breadcrumb-item">
					<a href="{{url('anggota/kondangan')}}">Kondangan</a>
				</li> 
				<li class="breadcrumb-item">
					<a href="{{url('anggota/kondangan/detail',@$kondangan->id)}}">{{@$kondangan->nama_kondangan}}</a>
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
					<a class="btn btn-success btn-sm" id="AddKondang">Tambah Tamu</a>
					<div class="table-responsive"> 
						<table class="table">
							<tr>
								<th>Nama Tamu</th> 
								<th>alamat</th> 
								<th>Aksi</th>
							</tr>
							 @foreach($dt_tamu as $key)
							 <tr>
								<td>{{$key->nama}}</td> 
								<td>{{$key->alamat}}</td> 
								<td><a class="btn btn-danger btn-sm hapus" data-id="{{$key->id}}">Hapus</a></td> 

							</tr>
							 @endforeach
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
                <h5 class="modal-title align-self-center mt-0">Isikan Data Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <div class="ms-alert"></div>
                <form id="prosesSimpan" name="prosesSimpan">
                    <div class="form-group">
                        <label>Nama Tamu</label>
                        <textarea class="form-control" name="nama"></textarea>
                    </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"></textarea>
                    </div>                    
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
	$(document).ready(function()
	{ 

			$('body').delegate('#AddKondang','click',function(e)
			{ 
				e.preventDefault();  
				window.id_edit=undefined;
				$('.ms-alert').empty(); 
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
				Form_item.append('id_undangan','{{@$kondangan->id}}');   
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
 

	});
</script>
 @endsection