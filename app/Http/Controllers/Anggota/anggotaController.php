<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
class anggotaController extends Controller
{
     public function home(Request $request) 
    {
         return view('anggota.home.dasboard');
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

	
	public function listtamu(Request $request) 
	{

		 

			$data 		=DB::table('tb_tamu');
						if(@$request->id_tamu)
						{

						 $data->where('id_undangan',@$request->id_tamu);
						}
						else
						{
							$data->where('id_user',Auth::user()->id);

						}
			$dt_tamu 	=$data->get(); 
			$kondangan=DB::table('tb_kondangan')->where('id',@$request->id_tamu)->first();

		return view('anggota.tamu.list',compact('dt_tamu','kondangan'));
	}

	public function simpantamu(Request $request) 
	{

		$alert='';
		$error=true;
		$alert.=$request->input('nama')?'':'<li>namakondangan  Wajib Di isi</li>'; 
		$alert.=$request->input('alamat')?'':'<li>alamat  Wajib Di isi</li>'; 
		

		if($alert=='')
		{ 

			$data['id_undangan']    =$request->input('id_undangan');
			$data['id_user']      	=Auth::user()->id; 
			$data['nomor_hp']     	=$request->input('nomor_hp');   
			$data['nama']  			=$request->input('nama'); 
			$data['alamat']     	=$request->input('alamat');    
			$data['updated_at']  	=Carbon::now();
 
			if($request->input('id_edit'))
			{ 
			    DB::table('tb_tamu')->where('id',$request->input('id_edit'))->update($data);
			    $alert ='<li>Update Telah Berhasil</li>'; 
			}else
			{

			    $data['created_at'] =Carbon::now(); 
			    DB::table('tb_tamu')->insert($data);
			    $alert ='<li>Simpan Telah Berhasil</li>';
			}
			$error=false;
		}
		print json_encode(array("alert"=>$alert,'error'=>$error));  

	}
public function hapustamu(Request $request) 
	{
		 DB::table('tb_tamu')->where('id',$request->input('id_hapus'))->delete();
		 	print json_encode(array('error'=>false));  

	}
public function pemasukanmagang(Request $request) 
	{
		 
		 return view('anggota.pemasukan_magang.list');

	}

	
}
