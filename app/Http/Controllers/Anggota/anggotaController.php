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

	public function mktimeWaktu($datestar, $dateend)
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
		$waktu_start 	= 	mktime($jam_start, $menit_start, $detik_start, $bulan_start, $hari_start, $tahun_start);
		$waktu_end 		= 	mktime($jam_end, $menit_end, $detik_end, $bulan_end, $hari_end, $tahun_end);
		$selisih_waktu	= 	$waktu_end - $waktu_start;
		return $this->RentanWaktu($selisih_waktu);
	}
	public function RentanWaktu($selisih_waktu)
	{
		$jam 	= floor($selisih_waktu / 3600);
		$sisa 	= $selisih_waktu % 3600;
		$menit 	= floor($sisa / 60);
		$sisa 	= $sisa % 60;
		$detik 	= floor($sisa / 1);
		return $jam . 'Jam ' . $menit . 'menit';
	}


	public function listtamu(Request $request)
	{


			$data 		=DB::table('tb_tamu');
			$data->select('tb_tamu.*','tb_kondangan.nama_kondangan'); 
			$data->leftJoin('tb_kondangan','tb_kondangan.id','=','tb_tamu.id_undangan');
			$data->where('tb_tamu.id_user',Auth::user()->id);   
			if(@$request->idtamu)
			{
				$data->where('tb_tamu.id_undangan',@$request->idtamu); 
			}	 
			if(@$request->input('cari'))
			{
					$data->where('tb_tamu.nama','like','%'.@$request->input('cari').'%'); 

					$data->orWhere('tb_tamu.id_user',Auth::user()->id);
					$data->where('tb_kondangan.nama_kondangan','like','%'.@$request->input('cari').'%');  
					if(@$request->idtamu)
					{
						$data->where('tb_tamu.id_undangan',@$request->idtamu); 
					}
			}
			$dt_tamu 	= $data->paginate(20);
		//$kondangan 	=DB::table('tb_kondangan')->where('id',@$request->id_tamu)->first();

		return view('anggota.tamu.list', compact('dt_tamu'));
	}

	public function simpantamu(Request $request)
	{


		$alert = '';
		$error = true;
		$alert .= $request->input('nama') ? '' : '<li>namakondangan  Wajib Di isi</li>';
		$alert .= $request->input('alamat') ? '' : '<li>alamat  Wajib Di isi</li>';


		if ($alert == '') {

			if ($request->input('id_undangan')) {
				$data['id_undangan']    = $request->input('id_undangan');
			}
			$data['id_user']      	= Auth::user()->id;
			$data['nomor_hp']     	= $request->input('nomor_hp');
			$data['nama']  			= $request->input('nama');
			$data['jenis_kelamin']  = $request->input('jenis_kelamin');
			$data['alamat']     	= $request->input('alamat');
			$data['updated_at']  	= Carbon::now();

			if ($request->input('id_edit')) {
				DB::table('tb_tamu')->where('id', $request->input('id_edit'))->update($data);
				$alert = '<li>Update Telah Berhasil</li>';
			} else {

				$data['created_at'] = Carbon::now();
				DB::table('tb_tamu')->insert($data);
				$alert = '<li>Simpan Telah Berhasil</li>';
			}
			$error = false;
		}
		print json_encode(array("alert" => $alert, 'error' => $error));
	}

	public function hapustamu(Request $request)
	{
		DB::table('tb_tamu')->where('id', $request->input('id_hapus'))->delete();
		print json_encode(array('error' => false));
	}

	public function pemasukanmagang(Request $request)
	{
		$data = DB::table('tb_magang');
		$data->select('tb_magang.*', 'tb_tamu.nama', 'tb_tamu.nomor_hp', 'tb_tamu.alamat', 'tb_kondangan.nama_kondangan');
		$data->leftJoin('tb_tamu', 'tb_tamu.id', '=', 'tb_magang.id_tamu');
		$data->leftJoin('tb_kondangan', 'tb_kondangan.id', '=', 'tb_tamu.id_undangan');


		if (@$request->input('cari') != '') {
			$data->where('tb_tamu.nama', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_tamu.nomor_hp', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_tamu.alamat', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_kondangan.nama_kondangan', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		} else {
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		}
		$data_list = $data->paginate(20);
		$jlh = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pemasukan magang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->sum('jumlah');
		$jlh_tamu = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pemasukan magang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->count();
		return view('anggota.pemasukan_magang.list', compact('data_list', 'jlh', 'jlh_tamu'));
	}
	public function simpanpemasukan(Request $request)
	{

		$alert = '';
		$error = true;
		$alert .= $request->input('satuan') ? '' : '<li>Total barang  Wajib Di isi</li>';
		if ($request->input('jenis_magang') != 'pengeluaran magang') {
			$data['id_tamu']     	 	= $request->input('id_tamu');
			$alert .= $request->input('id_tamu') ? '' : '<li>Tamu  Wajib Di isi</li>';
		} else {
			$alert .= $request->input('nama') ? '' : '<li>nama  Wajib Di isi</li>';
			$alert .= $request->input('alamat') ? '' : '<li>alamat  Wajib Di isi</li>';
			$alert .= $request->input('tanggal') ? '' : '<li>tanggal  Wajib Di isi</li>';
		}

		if ($alert == '') {
			if ($request->input('jenis_magang') == 'pengeluaran magang') {
				$datauser['nama'] 	 	= $request->input('nama');
				$datauser['alamat'] 	= $request->input('alamat');
				$datauser['tanggal'] 	= Carbon::parse($request->input('tanggal'))->format('Y-m-d');
				$datauser['updated_at'] = Carbon::now();
				if ($request->input('id_edit')) {
					DB::table('tb_tamu_magang')->where('id', $request->input('id_tamu'))->update($datauser);
					$data['id_tamu'] 		= $request->input('id_tamu');
				} else {
					$datauser['created_at'] = Carbon::now();
					$data['id_tamu'] 		= DB::table('tb_tamu_magang')->insertGetId($datauser);
				}
			}

			$data['jenis_barang']     	= $request->input('jenis_barang');
			$data['jenis_magang']  		= $request->input('jenis_magang');
			$nominal_satuan 			= $request->input('jenis_barang') == 'uang' ? 'rp' : 'kg';
			$data['jenis_satuan']     	= $nominal_satuan;
			$data['id_anggota']      	= Auth::user()->id;
			$data['id_undangan']      	= $request->input('id_undangan');
			$data['jumlah']      	 	= $request->input('satuan');
			$data['updated_at']  		= Carbon::now();
			$data['created_at'] 		= $request->input('created_at') ? Carbon::parse($request->input('created_at')) : Carbon::now();

			if ($request->input('id_edit')) {
				DB::table('tb_magang')->where('id', $request->input('id_edit'))->update($data);
				$alert = '<li>Update Telah Berhasil</li>';
			} else {

				DB::table('tb_magang')->insert($data);
				$alert = '<li>Simpan Telah Berhasil</li>';
			}
			$error = false;
		}
		print json_encode(array("alert" => $alert, 'error' => $error));
	}

	public function pemasukanhutang(Request $request)
	{
		$data = DB::table('tb_magang');
		$data->select('tb_magang.*', 'tb_tamu.nama', 'tb_tamu.nomor_hp', 'tb_tamu.alamat', 'tb_kondangan.nama_kondangan');
		$data->leftJoin('tb_tamu', 'tb_tamu.id', '=', 'tb_magang.id_tamu');
		$data->leftJoin('tb_kondangan', 'tb_kondangan.id', '=', 'tb_tamu.id_undangan');

		if (@$request->input('cari') != '') {

			$data->where('tb_tamu.nama', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan hutang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_tamu.nomor_hp', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan hutang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_tamu.alamat', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_kondangan.nama_kondangan', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pemasukan hutang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		} else {

			$data->where('tb_magang.jenis_magang', 'pemasukan hutang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		}
		$data_list = $data->paginate(20);
		$jlh = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pemasukan hutang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->sum('jumlah');

		$jlh_tamu = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pemasukan hutang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->count();
		return view('anggota.pemasukan_hutang.list', compact('data_list', 'jlh', 'jlh_tamu'));
	}

	public function pengeluaranmagang(Request $request)
	{
		$data = DB::table('tb_magang');
		$data->select('tb_magang.*', 'tb_tamu_magang.nama', 'tb_tamu_magang.alamat', 'tb_tamu_magang.tanggal', 'tb_kondangan.nama_kondangan');
		$data->leftJoin('tb_tamu_magang', 'tb_tamu_magang.id', '=', 'tb_magang.id_tamu');
		$data->leftJoin('tb_kondangan', 'tb_kondangan.id', '=', 'tb_magang.id_undangan');


		if (@$request->input('cari') != '') {
			$data->where('tb_tamu_magang.nama', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pengeluaran magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_tamu_magang.alamat', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pengeluaran magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);

			$data->Orwhere('tb_kondangan.nama_kondangan', 'like', '%' . @$request->input('cari') . '%');
			$data->where('tb_magang.jenis_magang', 'pengeluaran magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		} else {
			$data->where('tb_magang.jenis_magang', 'pengeluaran magang');
			$data->where('tb_magang.jenis_barang', @$request->type);
			$data->where('tb_magang.id_anggota', Auth::user()->id);
		}




		$data_list = $data->paginate(20);
		$jlh = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pengeluaran magang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->sum('jumlah');

		$jlh_tamu = DB::table('tb_magang')
			->where('tb_magang.jenis_barang', @$request->type)
			->where('tb_magang.jenis_magang', 'pengeluaran magang')
			->where('tb_magang.id_anggota', Auth::user()->id)
			->count();
		return view('anggota.pengeluaran_magang.list', compact('data_list', 'jlh', 'jlh_tamu'));
	}

	public function Hapus_pelayan(Request $request)
	{
		$data = DB::table('tb_magang')->where('id', $request->input('id'))->delete();
		print json_encode(array("error" => false));
	}


	public function dataUndangan(Request $request)
	{
		$data = DB::table('tb_kondangan');
		$data->select(
			'tb_kondangan.id',
			'tb_kondangan.nama_kondangan',
			'tb_kondangan.foto',
			'tb_kondangan.alamat',
			'tb_kondangan.status',
			'tb_kondangan.tgl_mulai',
			'tb_kondangan.tgl_selesai',
			DB::raw('count(tb_tamu.id) as Jumltb_tamu')
		);
		$data->LeftJoin('tb_tamu', 'tb_kondangan.id', '=', 'tb_tamu.id_undangan');
		$data->groupBy(
			'tb_kondangan.id',
			'tb_kondangan.nama_kondangan',
			'tb_kondangan.foto',
			'tb_kondangan.alamat',
			'tb_kondangan.status',
			'tb_kondangan.tgl_mulai',
			'tb_kondangan.tgl_selesai'
		);
		$data->where('id_anggota', Auth::user()->id);
		$data_list = $data->paginate(20);
		$i = 0;
		foreach ($data_list as $key) {
			$data_list[$i]->foto 			= asset('image/' . $key->foto);
			$data_list[$i]->lama_acara 		= $this->mktimeWaktu($key->tgl_mulai, $key->tgl_selesai);
			$tgl_mulai 				 		= Carbon::parse($key->tgl_mulai);
			$tgl_selesai 					= Carbon::parse($key->tgl_selesai);
			$data_list[$i]->tgl_mulai 		= $tgl_mulai->format('Y-m-d');
			$data_list[$i]->tgl_selesai 	= $tgl_selesai->format('Y-m-d');
			$data_list[$i]->jam_mulai 		= $tgl_mulai->format('H');
			$data_list[$i]->menit_mulai 	= $tgl_mulai->format('i');
			$data_list[$i]->jam_selesai 	= $tgl_selesai->format('H');
			$data_list[$i]->menit_selesai 	= $tgl_selesai->format('i');

			$i++;
		}
		return view('anggota.undangan.list', compact('data_list'));
	}

	public function simpankondangan(Request $request)
	{
		$alert = '';
		$error = true;
		$alert .= $request->input('nama_kondangan') ? '' : '<li>namakondangan  Wajib Di isi</li>';
		$alert .= $request->input('alamat') ? '' : '<li>alamat  Wajib Di isi</li>';
		$alert .= $request->input('tgl_mulai') ? '' : '<li>tgl_mulai  Wajib Di isi</li>';
		$alert .= $request->input('tgl_selesai') ? '' : '<li>tgl_selesai  Wajib Di isi</li>';
		$alert .= $request->input('jam_mulai') ? '' : '<li>jam_mulai  Wajib Di isi</li>';
		$alert .= $request->input('menit_mulai') ? '' : '<li>menit_mulai  Wajib Di isi</li>';
		$alert .= $request->input('jam_selesai') ? '' : '<li>jam_selesai  Wajib Di isi</li>';
		$alert .= $request->input('menit_selesai') ? '' : '<li>menit_selesai  Wajib Di isi</li>';

		if ($alert == '') {


			$data['nama_kondangan'] = $request->input('nama_kondangan');
			$data['alamat']         = $request->input('alamat');
			$data['tgl_mulai']      = Carbon::parse($request->input('tgl_mulai') . ' ' . $request->input('jam_mulai') . ':' . $request->input('menit_mulai') . ':00');
			$data['tgl_selesai']    = Carbon::parse($request->input('tgl_selesai') . ' ' . $request->input('jam_selesai') . ':' . $request->input('menit_selesai') . ':00');
			$data['updated_at']     = Carbon::now();

			if ($request->file('foto')) {
				$path            = public_path('image');
				$file            = $request->file('foto');
				$file_filename   = Carbon::now()->format('Ymdhis') . '.png';
				$file_image      = Image::make($file->getRealPath());
				$file_image->resize(600, null, function ($constraint) {
					$constraint->aspectRatio();
					$constraint->upsize();
				});
				$file_image->save($path . '/' . $file_filename);
				$data['foto'] = $file_filename;
			}

			if ($request->input('id_edit')) {
				DB::table('tb_kondangan')->where('id', $request->input('id_edit'))->update($data);
				$alert = '<li>Update Telah Berhasil</li>';
			} else {

				$data['id_anggota']     = Auth::user()->id;
				$data['status']         = 'non_aktif';
				$data['created_at']  	= Carbon::now();
				DB::table('tb_kondangan')->insert($data);
				$alert = '<li>Simpan Telah Berhasil</li>';
			}
			$error = false;
		}
		print json_encode(array("alert" => $alert, 'error' => $error));
	}


	public function loadundangan(Request $request)
	{
		$data = DB::table('tb_kondangan');
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
			DB::raw('count(tb_tamu.id) as Jumltb_tamu')
		);
		$data->LeftJoin('tb_tamu', 'tb_kondangan.id', '=', 'tb_tamu.id_undangan');
		$data->LeftJoin('users', 'users.id', '=', 'tb_kondangan.id_anggota');
		$data->where('tb_kondangan.id_anggota', Auth::user()->id);
		if ($request->input('cari')) {
			$data->where('tb_kondangan.nama_kondangan', 'like', '%' . $request->input('cari') . '%');
		}
		$data->groupBy(
			'tb_kondangan.id',
			'tb_kondangan.nama_kondangan',
			'tb_kondangan.foto',
			'tb_kondangan.alamat',
			'tb_kondangan.status',
			'tb_kondangan.tgl_mulai',
			'tb_kondangan.tgl_selesai',
			'users.name',
			'users.id'
		);
		$tb =  $data->paginate(10);
		$i = 0;
		foreach ($tb as $key) {
			$tb[$i]->foto           = asset('image/' . $key->foto);
			$tb[$i]->lama_acara     = $this->mktimeWaktu($key->tgl_mulai, $key->tgl_selesai);
			$tgl_mulai              = Carbon::parse($key->tgl_mulai);
			$tgl_selesai            = Carbon::parse($key->tgl_selesai);
			$tb[$i]->tgl_mulai      = $tgl_mulai->format('Y-m-d');
			$tb[$i]->tgl_selesai    = $tgl_selesai->format('Y-m-d');
			$tb[$i]->jam_mulai      = $tgl_mulai->format('H');
			$tb[$i]->menit_mulai    = $tgl_mulai->format('i');
			$tb[$i]->jam_selesai    = $tgl_selesai->format('H');
			$tb[$i]->menit_selesai  = $tgl_selesai->format('i');
			$tb[$i]->jam_menit_mulai = $tgl_selesai->format('H:i');

			$i++;
		}
		print json_encode(array("tb" => $tb));
	}
}
