<div class="left-sidenav">
	<ul class="metismenu left-sidenav-menu" id="side-nav">
		 <li>
			<a href="{{route('home')}}">
			<i class="fa fa-tachometer"></i>
			<span>Dashboard</span>
			</a>

			<li>
				<a href="{{route('anggotaundangan')}}">
				<i class="mdi mdi-calendar"></i>
				<span>Hajatan Saya</span>
				</a>
			</li>
		
		</li>
		 <li>
			<a href="{{route('anggotatamu')}}">
			<i class="fa fa-user"></i>
			<span>Data Tamu</span>
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
		<li class="menu-title">Lain-lain</li>
		<li>
			<a href="{{route('chatanggota')}}">
			<i class="fa fa-wechat "></i>
			<span>Chat</span>
			</a>
		</li>
	</ul>
</div> 