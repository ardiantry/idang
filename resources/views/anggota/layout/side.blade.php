<div class="left-sidenav">
	<ul class="metismenu left-sidenav-menu" id="side-nav">
		 <li>
			<a href="{{route('anggotatamu')}}">
			<i class="fa fa-user"></i>
			<span>Data Tamu</span>
			</a>
		</li>
		<li>
			<a href="{{route('anggotaundangan')}}">
			<i class="mdi mdi-calendar"></i>
			<span>Data Undangan</span>
			</a>
		</li>

		 <li class="menu-title">Kondangan</li>
		  <li>
            <a href="javascript: void(0);"><i class="mdi mdi-book-open-variant"></i><span>Pemasukan Magang</span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                	<a href="{{route('pemasukanmagang','beras')}}">
                		<i class="fa fa-pied-piper"></i><span>Beras</span>
                	</a>
		             <a href="{{route('pemasukanmagang','padi')}}">
                		<i class="fa fa-pagelines"></i><span>Padi</span>
                	</a>
                	 <a href="{{route('pemasukanmagang','uang')}}">
                		<i class="fa fa-dollar"></i><span>Uang</span>
                	</a>
        		</li> 
            </ul>
        </li>
		<li>
            <a href="javascript: void(0);"><i class="mdi mdi-book-open"></i><span>Pemasukan Hutang</span></a>
            <ul class="nav-second-level" aria-expanded="false">
                <li>
                	<a href="{{route('pemasukanhutang','beras')}}">
                		<i class="fa fa-pied-piper"></i><span>Beras</span>
                	</a>
		             <a href="{{route('pemasukanhutang','padi')}}">
                		<i class="fa fa-pagelines"></i><span>Padi</span>
                	</a>
                	 <a href="{{route('pemasukanhutang','uang')}}">
                		<i class="fa fa-dollar"></i><span>Uang</span>
                	</a>
        		</li> 
            </ul>
        </li>
		<li>
		    <a href="javascript: void(0);"><i class=" mdi mdi-book-open-page-variant"></i><span>Pengeluaran Magang</span></a>
		    <ul class="nav-second-level" aria-expanded="false">
		        <li>
		        	<a href="{{route('pengeluaranmagang','beras')}}">
		        		<i class="fa fa-pied-piper"></i><span>Beras</span>
		        	</a>
		             <a href="{{route('pengeluaranmagang','padi')}}">
		        		<i class="fa fa-pagelines"></i><span>Padi</span>
		        	</a>
		        	 <a href="{{route('pengeluaranmagang','uang')}}">
		        		<i class="fa fa-dollar"></i><span>Uang</span>
		        	</a>
				</li> 
		    </ul>
		</li>
		<li>
			 <a href="{{url('anggota/rekap-magang')}}"><i class=" mdi mdi-book-open-page-variant"></i><span>Rekapitulasi</span></a>
		   
		</li>
		<li class="menu-title">Lain-lain</li>
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
			<a href="{{route('chatanggota')}}">
			<i class="fa fa-wechat "></i>
			<span>Data Chat <span class="badge badge-danger">{{$jml}}</span></span>
			</a>
		</li>
	</ul>
</div> 