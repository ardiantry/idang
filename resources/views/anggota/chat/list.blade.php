 @extends('anggota.layout.app')
 @section('content') 
<style type="text/css">

.header-chat h3 {
  border: 1px solid #686363;
  padding: 10px;
  font-size: 22px;
  background: rgb(27, 182, 230);
  color: #fff;
  border-radius: 20px;
  text-align: center;
}
.header-chat ul {
  padding: 0;
  margin: 0;
  width: ;
  display: grid;
  min-height: 50px;
  max-height: 500px;
  overflow-y: scroll;
}
.header-chat li {
  display: block; 
  margin: 5px;
  padding: 8px;
  position: relative;
  text-align: center;
}


.header-chat .kiri {
  border-radius: 20px 20px 20px 0px;
  background: rgba(190, 104, 221, 0.56);
  width: 85%;
  text-align: left;
}
.header-chat .kiri span {
  position: absolute;
  z-index: 1;
  left: ;
  right: 20px;
  font-size: 10px;
  top: 3px;
}
.header-chat .kanan {
  border-radius: 20px 20px 0px 20px;
  background: rgba(44, 227, 193, 0.56);
  width: 85%;
  margin-left: 56px;
  text-align: right;
}
.header-chat .kanan span {
  position: absolute;
  z-index: 1;
  left: ;
  left: 20px;
  font-size: 10px;
  top: 3px;
}
</style>
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li> 
				 
				<li class="breadcrumb-item active">Chat</li>
			</ol>
		</div>
		<h4 class="page-title">Chat</h4></div> 
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
		 		<div class="row">  
		 			<div id="col" class="col-md-12">
						<div class="table-responsive"> 
							<table class="table">
								<tr>
									<th>Nama Anggota</th>  
									<th>Aksi</th>
								</tr>
								 @foreach($dt_anggota as $key)
								 <tr>
									<td>{{@$key->name}}</td>  
									<td><a class="btn btn-success btn-sm chatdia" data-id="{{$key->id}}" data-name="{{@$key->name}}">Chat</a></td> 

								</tr>
								 @endforeach
							</table>
						</div> 
		 			</div>
		 			<div id="listChat"> 
		 			</div>
				</div> 	
			</div>
		</div>
	</div>
 </div>
  
<script type="text/javascript">
$(document).ready(function()
{ 
 var timer=0;
$('body').delegate('.chatdia','click',function(e)
	{
		e.preventDefault();
		 clearTimeout(timer);
		$('#listChat').empty();
		 window.id_anggota=$(this).data('id');
		 window.nama_anggota=$(this).data('name');

		 $(this).closest('#col').removeClass('col-md-12').addClass('col-md-7');
		 $('#listChat').addClass('col-md-5');
		 $('#listChat').html(`<form id="kirimChat" name="kirimChat">
		 					<div class="header-chat">
		 						<h3>`+$(this).data('name')+`</h3> 
		 						<ul id="listChatdetail"> 
		 						<li>Belum ada Chat</li>
		 						</ul>
		 						<div class="input-group">
		 							<input type="text" name="pesannya" class="form-control"  required="">
									<span class="input-group-append">
									<button class="btn btn-primary" type="submit">Kirim</button>
									</span>
		 						</div>
		 					</div> 
		 				</form>`); 
		 getlischat();
		
	});

$('body').delegate('#kirimChat','submit',function(e)
{
	e.preventDefault();
	var this_=$(this);
	this_.find('button[type="submit"]').html('loading...');
	this_.find('button[type="submit"]').attr('disabled','disabled');
	const formsimpan  = document.forms.namedItem('kirimChat'); 
	const Form_item   = new FormData(formsimpan);
	Form_item.append('_token', '{{csrf_token()}}');   
	Form_item.append('id_anggota', window.id_anggota); 
	fetch('{{route('KirimChat')}}', { method: 'POST',body:Form_item}).then(res => res.json()).then(data => 
	{ 

		this_.find('button[type="submit"]').html('Simpan');
		this_.find('button[type="submit"]').removeAttr('disabled'); 
		getlischat();
	}); 	
});

function getlischat()
{
	var id_ku 		='{{@Auth::user()->id}}';
	var nama_ku 	='{{@Auth::user()->name}}';
	var nama_nya 	=window.nama_anggota; 
	const Formlist  =new FormData();
	Formlist.append('_token', '{{csrf_token()}}');   
	Formlist.append('id_anggota', window.id_anggota); 
	fetch('{{route('listChat')}}', { method: 'POST',body:Formlist}).then(res => res.json()).then(data => 
	{ 
		
			var list_=``;
			for(let lis of data.db_chat)
			{
				var saya=id_ku==lis.id_a?'kanan':'kiri'; 
				var name_chat=id_ku==lis.id_a?nama_ku:nama_nya;
				list_+=`<li class="`+saya+`"><span>`+name_chat+`</span>`+lis.chat+`</li>`;
			}
			if(data.db_chat.length!=0)
			{
				$('#listChatdetail').html(list_); 

			}
			}); 
		timer =setTimeout(function(){
		 getlischat();
		},3000);
}

});
</script>
 @endsection