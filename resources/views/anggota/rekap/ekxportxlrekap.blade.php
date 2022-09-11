 
@php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=Rekap.xls");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	$year=Carbon\Carbon::now()->format('Y');
	$mount=1;
	$data_g=array();
	$td='';
	for($i=0;$i<=11;$i++)
	{
		$bln=sprintf("%02d",$mount);

		$a=DB::table('tb_magang')
		->where('jenis_magang','pemasukan magang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();

		$a_beras=DB::table('tb_magang') 
		->where('jenis_magang','pemasukan magang')
		->where('jenis_barang','beras') 
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');

		$a_padi=DB::table('tb_magang') 
		->where('jenis_magang','pemasukan magang')
		->where('jenis_barang','padi') 
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');

		$a_uang=DB::table('tb_magang') 
		->where('jenis_magang','pemasukan magang')
		->where('jenis_barang','uang') 
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');

		$b=DB::table('tb_magang')
		->where('jenis_magang','pemasukan hutang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();

		$b_beras=DB::table('tb_magang')
		->where('jenis_magang','pemasukan hutang')
		->where('jenis_barang','beras')  
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');
		$b_padi=DB::table('tb_magang')
		->where('jenis_magang','pemasukan hutang')
		->where('jenis_barang','padi')  
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');
		$b_uang=DB::table('tb_magang')
		->where('jenis_magang','pemasukan hutang')
		->where('jenis_barang','uang')  
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');

		$c=DB::table('tb_magang')
		->where('jenis_magang','pengeluaran magang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();
		$c_beras=DB::table('tb_magang')
		->where('jenis_magang','pengeluaran magang')
		->where('jenis_barang','beras')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');
		$c_padi=DB::table('tb_magang')
		->where('jenis_magang','pengeluaran magang')
		->where('jenis_barang','padi')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');
		$c_uang=DB::table('tb_magang')
		->where('jenis_magang','pengeluaran magang')
		->where('jenis_barang','uang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->sum('jumlah');

		$data_g[$i]=array('y'=>strval($year.'-'.$bln),'a'=>$a,'b'=>$b,'c'=>$c);
	$td.='<tr>
		<td>'.strval($year.'-'.$bln).'</td>
		<td>'.$a_beras.'Kg</td>
		<td>'.$a_padi.'Kg</td>
		<td>Rp. '.number_format($a_uang,0,'.','.').'</td>
		<td>'.$a.'</td>
		<td>'.$b_beras.'Kg</td>
		<td>'.$b_padi.'Kg</td>
		<td>Rp. '.number_format($b_uang,0,'.','.').'</td>
		<td>'.$b.'</td> 
		<td>'.$c_beras.'Kg</td>
		<td>'.$c_padi.'Kg</td>
		<td>Rp. '.number_format($c_uang,0,'.','.').'</td>
		<td>'.$c.'</td>

	</tr>';
	$mount++;
	}
	@endphp
  
	<table  border="1" style="border: 1;">
		<thead>
			<tr>
			<th rowspan="2">Bulan</th>
			<th  colspan="3">Pemasukan Magang</th>
			<th  rowspan="2">Jml Magang</th>

			<th   colspan="3">Pemasukan Hutang</th>
			<th  rowspan="2">Jml Hutang</th>

			<th   colspan="3">Pengeluaran Magang</th> 
			<th  rowspan="2">Jml Pengeluaran</th> 
			</tr>
			<tr>
				<th >Beras</th>  
				<th >Padi</th> 
				<th >Uang</th> 

				<th >Beras</th>  
				<th >Padi</th> 
				<th >Uang</th> 

				<th >Beras</th>  
				<th >Padi</th> 
				<th >Uang</th> 
			</tr>
		</thead>
		<tbody>
				{!!$td!!}
		</tbody>
	</table>
