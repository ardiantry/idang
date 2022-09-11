<div class="left-sidenav">
	<ul class="metismenu left-sidenav-menu" id="side-nav">
		<li>
			<a href="{{route('homeadmin')}}">
			<i class="fa fa-tachometer"></i>
			<span>Dashboard</span>
			</a>
		</li>
		<li>
			<a href="{{route('adminhajatan')}}"> 
			<i class="mdi mdi-calendar"></i>
			<span>Data Hajatan</span>
			</a>
		</li>
		<li>
		<li>
			<a href="{{route('listanggota')}}">
			<i class="fa fa-user"></i>
			<span>Data Anggota</span>
			</a>
		</li>
		<li>
			<a href="{{route('adminmasyarakat')}}">
			<i class="fa fa-user"></i>
			<span>Data Masyarakat</span>
			</a>
		</li>
		
		<li>
			@php
			$id_ku=Auth::user()->id; 
			$data=DB::table('tb_chat');
			$data->where('id_a',$id_ku);  
			$data->Orwhere('id_b',$id_ku);  
			$db_chat=$data->get(); 
			$data_=array();
			foreach($db_chat as $key)
			{
				$k_dia='';
				if($key->id_a==$id_ku)
				{
					$k_dia=$key->id_b;
				}
				if($key->id_b==$id_ku)
				{
					$k_dia=$key->id_a;
				}
				$data_[$k_dia]=$k_dia;

			}
			$jml=count($data_);
			@endphp
			<a href="{{route('chatadmin')}}">
			<i class="fa fa-wechat "></i>
			<span>Data Chat <span class="badge badge-danger">{{$jml}}</span></span>
			</a>
		</li>
	</ul> 
</div> 