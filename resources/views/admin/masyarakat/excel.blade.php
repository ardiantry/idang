<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=datamasarakat.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<style type="text/css">
	table td{
		padding: 3px;
		text-align: center;
		border: 1px;
	}
</style>
<table class="table">
	<tr>
		<th>Nama Tamu</th> 
		<th>No Telp</th>  
		<th>Alamat</th> 
		<th>Jenis Kelamin</th>  
		@if(@$kondangan->nama_kondangan)
		<th>Kondangan</th> 
		@endif 
	</tr>
	 @foreach($dt_tamu as $key)
	 @php
	 $jenis_kelamin=$key->jenis_kelamin=='l'?'laki-laki':'perempuan';
	 @endphp
	 <tr>
		<td>{{$key->nama}}</td> 
		<td>{{$key->nomor_hp}}</td> 
		<td>{{$key->alamat}}</td> 
		<td>{{$jenis_kelamin}}</td>    
	</tr>
	 @endforeach
</table>  