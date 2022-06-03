<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class adminController extends Controller
{
     public function home(Request $request) 
    { 
    	
         return view('admin.home.dasboard');
    }

 public function listanggota(Request $request) 
    { 
    	$data_list=DB::table('users')->where('status','user')->paginate(20);
         return view('admin.anggota.list',compact('data_list'));
    }
     public function dataUndangan(Request $request) 
    { 
    	 $data_list=DB::table('tb_kondangan')
                ->select(
                	'tb_kondangan.id',
                	'tb_kondangan.nama_kondangan',
                	'tb_kondangan.foto',
                	'tb_kondangan.alamat',
                	'tb_kondangan.status',
                	'tb_kondangan.tgl_mulai', 
                	'tb_kondangan.tgl_selesai', 
                	DB::raw('count(tb_tamu.id) as Jumltb_tamu'))
               		->LeftJoin('tb_tamu','tb_kondangan.id','=','tb_tamu.id_undangan') 
               		->groupBy(
               		'tb_kondangan.id',
                	'tb_kondangan.nama_kondangan',
                	'tb_kondangan.foto',
                	'tb_kondangan.alamat',
                	'tb_kondangan.status',
                	'tb_kondangan.tgl_mulai', 
                	'tb_kondangan.tgl_selesai')
                	->paginate(20); 
                	$i=0;
                	foreach ($data_list as $key) 
                	{
                		$data_list[$i]->foto 			=asset('image/'.$key->foto);  
                		$data_list[$i]->lama_acara 		=$this->mktimeWaktu($key->tgl_mulai,$key->tgl_selesai); 
                		$tgl_mulai 				 		=Carbon::parse($key->tgl_mulai);
                		$tgl_selesai 					=Carbon::parse($key->tgl_selesai);
						$data_list[$i]->tgl_mulai 		=$tgl_mulai->format('Y-m-d'); 
						$data_list[$i]->tgl_selesai 	=$tgl_selesai->format('Y-m-d');  
                		$data_list[$i]->jam_mulai 		=$tgl_mulai->format('H'); 
                		$data_list[$i]->menit_mulai 	=$tgl_mulai->format('i');  
                		$data_list[$i]->jam_selesai 	=$tgl_selesai->format('H'); 
                		$data_list[$i]->menit_selesai 	=$tgl_selesai->format('i');  

                		$i++;
                	}
         return view('admin.undangan.list',compact('data_list'));
    }

    public function mktimeWaktu($datestar,$dateend)
	{
		$start 			= 	new Carbon($datestar);
		$end 			= 	new Carbon($dateend);
		$jam_start 		=	$start->format('H');
		$menit_start 	=	$start->format('i');
		$detik_start 	=	$start->format('s');
		$bulan_start 	=	$start->format('m');
		$hari_start 	=	$start->format('d');
		$tahun_start 	=	$start->format('Y');

		$jam_end 		=	$end->format('H');
		$menit_end 		=	$end->format('i');
		$detik_end 		=	$end->format('s');
		$bulan_end 		=	$end->format('m');
		$hari_end 		=	$end->format('d');
		$tahun_end 	 	=	$end->format('Y');
		$waktu_start 	= 	mktime($jam_start,$menit_start,$detik_start,$bulan_start,$hari_start,$tahun_start);
		$waktu_end 		= 	mktime($jam_end,$menit_end,$detik_end,$bulan_end,$hari_end,$tahun_end);
		$selisih_waktu	= 	$waktu_end-$waktu_start;
		return $this->RentanWaktu($selisih_waktu);
	}
	public function RentanWaktu($selisih_waktu)
	{  
		$jam 	= floor($selisih_waktu/3600);
		$sisa 	= $selisih_waktu % 3600;
		$menit 	= floor($sisa/60);
		$sisa 	= $sisa % 60;
		$detik 	= floor($sisa/1);
		return $jam.'Jam '.$menit.'menit'; 
	} 

}
