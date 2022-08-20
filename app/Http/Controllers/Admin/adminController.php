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
    	$data=DB::table('users');
        $data->where('status','user');
         if(@$request->input('cari')!='')
         {
            $data->where('name','like','%'.@$request->input('cari').'%');
         }
        $data_list=$data->paginate(20);
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
    public function adminundangan(Request $request) 
    {
         return view('admin.undangan.list');
    }
    public function simpankondangan(Request $request) 
    {
       

             
            
            $data['status']         =$request->input('aktif');  
                DB::table('tb_kondangan')->where('id',$request->input('id_edit'))->update($data);
            $alert ='<li>Update Telah Berhasil</li>'; 
            
            $error=false; 
        print json_encode(array("alert"=>$alert,'error'=>$error));   
    }
    public function loadundangan(Request $request) 
    {
         $data=DB::table('tb_kondangan');
                $data->select(
                    'tb_kondangan.id',
                    'tb_kondangan.nama_kondangan',
                    'tb_kondangan.foto',
                    'tb_kondangan.alamat',
                    'tb_kondangan.status',
                    'tb_kondangan.tgl_mulai', 
                    'tb_kondangan.tgl_selesai', 
                    'users.name', 
                    'users.id as id_anggota',
                    DB::raw('count(tb_tamu.id) as Jumltb_tamu'));
                   $data->LeftJoin('tb_tamu','tb_kondangan.id','=','tb_tamu.id_undangan');
                    $data->LeftJoin('users','users.id','=','tb_kondangan.id_anggota');
                    if($request->input('cari'))
                    {
                    $data->where('tb_kondangan.nama_kondangan','like',$request->input('cari').'%'); 
                    }
                    //->where('tb_kondangan.id_anggota',Auth::user()->id)
                    $data->groupBy(
                    'tb_kondangan.id',
                    'tb_kondangan.nama_kondangan',
                    'tb_kondangan.foto',
                    'tb_kondangan.alamat',
                    'tb_kondangan.status',
                    'tb_kondangan.tgl_mulai', 
                    'tb_kondangan.tgl_selesai',
                    'users.name','users.id');
                   $tb= $data->paginate(50); 
                    $i=0;
                    foreach ($tb as $key) 
                    {
                        $tb[$i]->foto           =asset('image/'.$key->foto);  
                        $tb[$i]->lama_acara     =$this->mktimeWaktu($key->tgl_mulai,$key->tgl_selesai); 
                        $tgl_mulai              =Carbon::parse($key->tgl_mulai);
                        $tgl_selesai            =Carbon::parse($key->tgl_selesai);
                        $tb[$i]->tgl_mulai      =$tgl_mulai->format('Y-m-d'); 
                        $tb[$i]->tgl_selesai    =$tgl_selesai->format('Y-m-d');  
                        $tb[$i]->jam_mulai      =$tgl_mulai->format('H'); 
                        $tb[$i]->menit_mulai    =$tgl_mulai->format('i');  
                        $tb[$i]->jam_selesai    =$tgl_selesai->format('H'); 
                        $tb[$i]->menit_selesai  =$tgl_selesai->format('i');  
                        $tb[$i]->jam_menit_mulai=$tgl_selesai->format('H:i');  

                        $i++;
                    }
       print json_encode(array("tb"=>$tb));  
    }
    public function hapusundangan(Request $request) 
    {
        DB::table('tb_kondangan')->where('id',$request->input('id_hapus'))->delete();
        print json_encode(array("error"=>false));
    }

    public function detailkondangan(Request $request) 
    {
        
         $tb        =DB::table('tb_kondangan')
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
                @$tb->foto          =asset('image/'.@$tb->foto);  
                @$tb->lama_acara    =$this->mktimeWaktu(@$tb->tgl_mulai,@$tb->tgl_selesai); 
                @$tgl_mulai         =Carbon::parse(@$tb->tgl_mulai);
                @$tgl_selesai       =Carbon::parse(@$tb->tgl_selesai);
                @$tb->tgl_mulai     =$tgl_mulai->format('Y-m-d'); 
                @$tb->tgl_selesai   =$tgl_selesai->format('Y-m-d');  
                @$tb->jam_mulai     =$tgl_mulai->format('H'); 
                @$tb->menit_mulai   =$tgl_mulai->format('i');  
                @$tb->jam_selesai   =$tgl_selesai->format('H'); 
                @$tb->menit_selesai =$tgl_selesai->format('i');             
        return view('admin.undangan.detail',compact('tb')); 
    }

    public function admintamu(Request $request) 
    {

         

            $data       =DB::table('tb_masarakat');
            if(@$request->input('cari')!='')
            {
                $data->where('nama','like','%'.@$request->input('cari').'%');
            }
            $data->orderBy('id','DESC'); 
            $dt_tamu    =$data->paginate(20);  

        return view('admin.tamu.list',compact('dt_tamu'));
    }
    public function chatadmin(Request $request) 
    {

        $dt_anggota=DB::table('users')->where('id','!=',Auth::user()->id)->paginate(20);
        return view('admin.chat.list',compact('dt_anggota'));
   
    }
    public function hapustamuadmin(Request $request) 
    {

         DB::table('tb_masarakat')->where('id',$request->input('id_hapus'))->delete();
            print json_encode(array('error'=>false));   
    }
    public function simpantamuadmin(Request $request) 
    {

        $alert='';
        $error=true;
        $alert.=$request->input('nama')?'':'<li>namakondangan  Wajib Di isi</li>'; 
        $alert.=$request->input('alamat')?'':'<li>alamat  Wajib Di isi</li>'; 
        

        if($alert=='')
        { 

            if($request->input('id_undangan'))
            {
                $data['id_undangan']    =$request->input('id_undangan');
                
            }
            $data['id_user']        =Auth::user()->id; 
            $data['nomor_hp']       =$request->input('nomor_hp');   
            $data['nama']           =$request->input('nama'); 
            $data['jenis_kelamin']  =$request->input('jenis_kelamin');  
            $data['alamat']         =$request->input('alamat');    
            $data['updated_at']     =Carbon::now();
 
            if($request->input('id_edit'))
            { 
                DB::table('tb_masarakat')->where('id',$request->input('id_edit'))->update($data);
                $alert ='<li>Update Telah Berhasil</li>'; 
            }else
            {

                $data['created_at'] =Carbon::now(); 
                DB::table('tb_masarakat')->insert($data);
                $alert ='<li>Simpan Telah Berhasil</li>';
            }
            $error=false;
        }
        print json_encode(array("alert"=>$alert,'error'=>$error)); 
    }
    public function hapusanggota(Request $request) 
    {

         DB::table('users')->where('id',$request->id_delete)->delete();
            print json_encode(array('error'=>false));   
        return redirect('admin/list-anggota');

    }
    public function exportdtmasarakat(Request $request) 
    { 
          $data       =DB::table('tb_masarakat');
            if(@$request->input('cari')!='')
            {
                $data->where('nama','like','%'.@$request->input('cari').'%');
            }
            $data->orderBy('id','DESC'); 
            $dt_tamu    =$data->get();  

        return view('admin.tamu.excel',compact('dt_tamu'));

    }
    
    
}

