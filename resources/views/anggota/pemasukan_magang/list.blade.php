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
 @endphp
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li>  
				<li class="breadcrumb-item">Pemasukan Mangang</li>
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
						<h3>Tambah Magang {{Request::segment(3)}}</h3>
						<form name="tambahmagang" id="tambahmagang">
							<div class="form-group">
								<label>Nama Undangan</label>
								<select class="form-control" name="id_undangan">
									@php
									$dbkondangan=DB::table('tb_kondangan')->get();
									@endphp
									@foreach($dbkondangan as $key)
									<option value="{{ $key->id}}">{{$key->nama_kondangan}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>{{$label_satuan}}</label>
								 <input type="text" name="satuan" placeholder="{{$nominal_satuan}}" class="form-control">
							</div>
							<button type="submit" class="btn btn-success btn-sm">Simpan</button>
						</form>
					</div>
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