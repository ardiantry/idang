@extends('anggota.layout.app')
@section('content') 
<link rel="stylesheet" href="{{asset('asset/plugins/morris/morris.css')}}">
<style type="text/css">
	#pie-chart,#bar-chart{
  min-height: 250px;
}
</style>
@php
	$db_pie=DB::table('tb_magang')->where('id_anggota',Auth::user()->id)->orderBy('created_at')->get();

	$hutang=0;
	$magang=0;
	$pengeluaran=0;


	@endphp
	@foreach($db_pie as $ky)
	 @if($ky->jenis_magang=='pemasukan magang')
		 @php
		 	$magang++;
		 @endphp
	 @elseif($ky->jenis_magang=='pemasukan hutang')
		 @php
		 	$hutang++;
		 @endphp 
	 @else
		 @php
		 	$pengeluaran++;
		 @endphp
	 @endif
	@endforeach;
	@php
	$dt_pie=array(
		array('label'=>'Pemasukan Magang','value'=>$magang),
		array('label'=>'Pemasukan Hutang','value'=>$hutang),
		array('label'=>'Pengeluaran Magang','value'=>$pengeluaran),

	);
	$year=Carbon\Carbon::now()->format('Y');
$mount=1;
$data_g=array();
	for($i=0;$i<=11;$i++)
	{
		$bln=sprintf("%02d",$mount);
		$a=DB::table('tb_magang')
		->where('jenis_magang','pemasukan magang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();
		$b=DB::table('tb_magang')
		->where('jenis_magang','pemasukan hutang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();
		$c=DB::table('tb_magang')
		->where('jenis_magang','pengeluaran magang')
		->where('id_anggota',Auth::user()->id)
		->whereMonth('created_at',$mount)
		->whereYear('created_at',$year) 
		->count();
		$data_g[$i]=array('y'=>strval($year.'-'.$bln),'a'=>$a,'b'=>$b,'c'=>$c);
$mount++;
	}
	@endphp
 <div class="row"> 
	<div class="col-md-12">
		<div class="float-right">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{url('anggota')}}">Home</a>
				</li>  
				<li class="breadcrumb-item">Rekapitulasi</li> 
			</ol>
		</div>
		<h4 class="page-title">{{Request::segment(3)}}</h4>
	</div> 
	<div class="col-md-4">
		<div class="card"> 
			<div class="card-body">
			<h4>Data Rekapitulasi Magang</h4>
			<div id="pie-chart" ></div>
			</div>
				

		</div>
	</div>
	<div class="col-md-8">
		<div class="card"> 
			<div class="card-body">

			<h4>Grafik Magang</h4>
			<div id="bar-chart"></div>
			</div>

		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
							<th>Tahun</th>
							<th>Pemasukan Magang</th>
							<th>Pemasukan Hutang</th>
							<th>Pengeluaran Magang</th> 
							<th>Nominal</th>
							<th>Kg</th> 
							<th>Jumlah Tamu</th>  
							</tr>
						</thead>
					</table>
				</div> 

			</div>
				
		</div>
	</div>
</div> 
<script src="{{asset('asset/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('asset/plugins/raphael/raphael-min.js')}}"></script>
<script type="text/javascript">

Morris.Donut({
  element: 'pie-chart',
  data: {!!json_encode($dt_pie)!!}
});
var data = {!!json_encode($data_g)!!};
console.log(data);
new Morris.Area({
                element: 'bar-chart',
                data:data,
                xkey: 'y',
                ykeys: ['a', 'b', 'c'],
                labels: ['Pemasukan Magang', 'Pemasukan Hutang', 'Pengeluaran Magang'],
                fillOpacity: 0.4,
                lineColors: ['#44a2d2', '#0acf97', '#f9bc0b'],
                pointFillColors: ['#ffffff'],
                resize: true,
                pointStrokeColors: ['black'],
                behaveLikeLine: true
            });
</script>
@endsection