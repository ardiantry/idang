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
    public function kondangan(Request $request) 
    {
         return view('anggota.kondangan.list');
    }
	public function simpankondangan(Request $request) 
	{
		$alert='';
		$error=true;
		$alert.=$request->input('nama_kondangan')?'':'<li>namakondangan  Wajib Di isi</li>';
		$alert.=$request->input('aktif')?'':'<li>aktif  Wajib Di isi</li>';  
		$alert.=$request->input('alamat')?'':'<li>alamat  Wajib Di isi</li>'; 
		$alert.=$request->input('tgl_mulai')?'':'<li>tgl_mulai  Wajib Di isi</li>'; 
		$alert.=$request->input('tgl_selesai')?'':'<li>tgl_selesai  Wajib Di isi</li>'; 
		$alert.=$request->input('jam_mulai')?'':'<li>jam_mulai  Wajib Di isi</li>'; 
		$alert.=$request->input('menit_mulai')?'':'<li>menit_mulai  Wajib Di isi</li>'; 
		$alert.=$request->input('jam_selesai')?'':'<li>jam_selesai  Wajib Di isi</li>';
		$alert.=$request->input('menit_selesai')?'':'<li>menit_selesai  Wajib Di isi</li>';

		if($alert=='')
		{ 

			$data['id_anggota']     =Auth::user()->id;
			$data['nama_kondangan'] =$request->input('nama_kondangan'); 
			$data['alamat']     	=$request->input('alamat');  
			$data['status']      	=$request->input('aktif');
			$data['tgl_mulai']    	=Carbon::parse($request->input('tgl_mulai').' '.$request->input('jam_mulai').':'.$request->input('menit_mulai').':00' );  
			$data['tgl_selesai']    =Carbon::parse($request->input('tgl_selesai').' '.$request->input('jam_selesai').':'.$request->input('menit_selesai').':00' );   
			$data['updated_at']  	=Carbon::now();

			if($request->file('foto'))
            {
                    $path            =public_path('image');
                    $file            =$request->file('foto');
                    $file_filename   =Carbon::now()->format('Ymdhis').'.png';             
                    $file_image      =Image::make($file->getRealPath()); 
                    $file_image->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $file_image->save($path.'/'.$file_filename);
                    $data['foto']=$file_filename; 
            }
           
			if($request->input('id_edit'))
			{ 
			    DB::table('tb_kondangan')->where('id',$request->input('id_edit'))->update($data);
			    $alert ='<li>Update Telah Berhasil</li>'; 
			}else
			{

			    $data['created_at'] =Carbon::now(); 
			    DB::table('tb_kondangan')->insert($data);
			    $alert ='<li>Simpan Telah Berhasil</li>';
			}
			$error=false;
		}
		print json_encode(array("alert"=>$alert,'error'=>$error));   
	}
	public function loadKondangan(Request $request) 
	{
		 $tb=DB::table('tb_kondangan')
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
                	->where('tb_kondangan.id_anggota',Auth::user()->id)
               		->groupBy(
               		'tb_kondangan.id',
                	'tb_kondangan.nama_kondangan',
                	'tb_kondangan.foto',
                	'tb_kondangan.alamat',
                	'tb_kondangan.status',
                	'tb_kondangan.tgl_mulai', 
                	'tb_kondangan.tgl_selesai')
                	->paginate(10); 
                	$i=0;
                	foreach ($tb as $key) 
                	{
                		$tb[$i]->foto 			=asset('image/'.$key->foto);  
                		$tb[$i]->lama_acara 	=$this->mktimeWaktu($key->tgl_mulai,$key->tgl_selesai); 
                		$tgl_mulai 				=Carbon::parse($key->tgl_mulai);
                		$tgl_selesai 			=Carbon::parse($key->tgl_selesai);
						$tb[$i]->tgl_mulai 		=$tgl_mulai->format('Y-m-d'); 
						$tb[$i]->tgl_selesai 	=$tgl_selesai->format('Y-m-d');  
                		$tb[$i]->jam_mulai 		=$tgl_mulai->format('H'); 
                		$tb[$i]->menit_mulai 	=$tgl_mulai->format('i');  
                		$tb[$i]->jam_selesai 	=$tgl_selesai->format('H'); 
                		$tb[$i]->menit_selesai 	=$tgl_selesai->format('i');  

                		$i++;
                	}
       print json_encode(array("tb"=>$tb));  
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

	public function hapuskondangan(Request $request) 
	{
		DB::table('tb_kondangan')->where('id',$request->input('id_hapus'))->delete();
  		print json_encode(array("error"=>false));
	}

	public function detailkondangan(Request $request) 
	{
		
		 $tb 		=DB::table('tb_kondangan')
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
                	->where('tb_kondangan.id_anggota',Auth::user()->id)
                	->where('tb_kondangan.id',@$request->id_kondangan)
               		->groupBy(
               		'tb_kondangan.id',
                	'tb_kondangan.nama_kondangan',
                	'tb_kondangan.foto',
                	'tb_kondangan.alamat',
                	'tb_kondangan.status',
                	'tb_kondangan.tgl_mulai', 
                	'tb_kondangan.tgl_selesai')
                	->first();
				@$tb->foto 			=asset('image/'.@$tb->foto);  
				@$tb->lama_acara 	=$this->mktimeWaktu(@$tb->tgl_mulai,@$tb->tgl_selesai); 
				@$tgl_mulai 		=Carbon::parse(@$tb->tgl_mulai);
				@$tgl_selesai 		=Carbon::parse(@$tb->tgl_selesai);
				@$tb->tgl_mulai 	=$tgl_mulai->format('Y-m-d'); 
				@$tb->tgl_selesai 	=$tgl_selesai->format('Y-m-d');  
				@$tb->jam_mulai 	=$tgl_mulai->format('H'); 
				@$tb->menit_mulai 	=$tgl_mulai->format('i');  
				@$tb->jam_selesai 	=$tgl_selesai->format('H'); 
				@$tb->menit_selesai =$tgl_selesai->format('i');         	
        return view('anggota.kondangan.detail',compact('tb')); 
	}
	public function listtamu(Request $request) 
	{
		$data 		=DB::table('tb_tamu');
					 $data->where('id_undangan',@$request->id_tamu);
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

	
}
