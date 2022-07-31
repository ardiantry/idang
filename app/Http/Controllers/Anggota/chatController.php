<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
class chatController extends Controller
{
     public function chatanggota(Request $request) 
    {
		$dt_anggota=DB::table('users')->where('id','!=',Auth::user()->id)->paginate(20);
		return view('anggota.chat.list',compact('dt_anggota'));
    }
    public function KirimChat(Request $request) 
    {
		 $data['id_a']=Auth::user()->id;
		 $data['id_b']=$request->input('id_anggota');
		 $data['chat']=$request->input('pesannya');
		 $data['created_at']=Carbon::now(); 
		 $data['updated_at']=Carbon::now();
		 DB::table('tb_chat')->insert($data);
		print json_encode(array('error'=>false));   

    }

	public function listChat(Request $request) 
	{	
		$db_chat=array();
		 $id_ku=Auth::user()->id;
		 $id_dia=$request->input('id_anggota');

		 $data=DB::table('tb_chat');
		 $data->where('id_a',$id_ku);
		 $data->where('id_b',$id_dia); 
		 $data->Orwhere('id_a',$id_dia);
		 $data->where('id_b',$id_ku);
		 $data->orderBy('created_at','ASC');
		 if(@$request->input('satuan')=='ya')
		 {
				$db_chat=$data->first();
		 }
		 else
		 {
				$db_chat=$data->get();
		 } 

		print json_encode(array('db_chat'=>$db_chat));   

	}

	
}
