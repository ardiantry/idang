<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
|
*/


Route::get('/', 'HomeController@index');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	// admin Area
	Route::group(['middleware' => 'AdminMiddleware'], function () {
		Route::group(['prefix' => 'admin'], function () {
			Route::group(['namespace' => 'Admin'], function () {
				Route::get('/', function () {
					return  redirect('admin/home/dasboard');
				});
				Route::get('/home/dasboard', 'adminController@home')->name('homeadmin');
				Route::get('/list-anggota', 'adminController@listanggota')->name('listanggota');
				Route::get('/data-Undangan', 'adminController@dataUndangan')->name('dataUndangan');

				Route::get('/hajatan', 'adminController@adminhajatan')->name('adminhajatan');

				Route::post('/undangan/simpan-kondangan', 'adminController@simpankondangan')->name('simpanundangan');
				Route::post('/undangan/load-Kondangan', 'adminController@loadundangan')->name('loadundangan');
				Route::post('/undangan/hapus-kondangan', 'adminController@hapusundangan')->name('hapusundangan');
				Route::get('/undangan/detail/{id_kondangan}', 'adminController@detailkondangan');
				Route::get('/undangan/tamu/{id_tamu}', 'adminController@listtamu')->name('adminlisttamu');



				Route::get('/masyarakat', 'adminController@adminmasyarakat')->name('adminmasyarakat');

				Route::get('/tamu', 'adminController@admintamu')->name('admintamu');
				Route::get('/export-dtmasarakat', 'adminController@exportdtmasarakat');



				Route::post('/kondangan/tamu/hapustamuadmin', 'adminController@hapustamuadmin')->name('hapustamuadmin');
				Route::post('/kondangan/tamu/simpantamuadmin', 'adminController@simpantamuadmin')->name('simpantamuadmin');
				Route::get('/chat-admin', 'adminController@chatadmin')->name('chatadmin');
				Route::get('/hapusanggota/{id_delete}', 'adminController@hapusanggota')->name('hapusanggota');
			});
		});
	});
	// admin Area

	// anggota area
	Route::group(['prefix' => 'anggota'], function () {
		Route::group(['namespace' => 'Anggota'], function () {
			Route::get('/', function () {
				return  redirect('anggota/home/dasboard');
			});
			//Route::get('/home', 'anggotaController@home');
			Route::get('/home', function () {
				return  redirect('anggota/home/dasboard');
			});

			// kondangan

			Route::get('/home/dasboard', 'anggotaController@home')->name('home');
			Route::get('/kondangan/tamu/{id_tamu}', 'anggotaController@listtamu')->name('listtamu');
			Route::post('/kondangan/tamu/simpan-tamu', 'anggotaController@simpantamu')->name('simpantamu');
			Route::post('/kondangan/tamu/hapus-tamu', 'anggotaController@hapustamu')->name('hapustamu');


			Route::get('/chat-anggota', 'chatController@chatanggota')->name('chatanggota');
			Route::post('/chat-anggota/Kirim-chat', 'chatController@KirimChat')->name('KirimChat');
			Route::post('/chat-anggota/list-chat', 'chatController@listChat')->name('listChat');


			Route::get('/chat-anggota', 'chatController@chatanggota')->name('chatanggota');
			Route::post('/chat-anggota/Kirim-chat', 'chatController@KirimChat')->name('KirimChat');
			Route::post('/chat-anggota/list-chat', 'chatController@listChat')->name('listChat');

			// tamu
			Route::get('/tamu/list/{idtamu}', 'anggotaController@listtamu')->name('anggotatamu');
			Route::get('/tamu/list', 'anggotaController@listtamu')->name('anggotatamu');

			//magang
			Route::get('/pemasukan-magang/{type}', 'anggotaController@pemasukanmagang')->name('pemasukanmagang');
			Route::post('/simpan-pemasukan', 'anggotaController@simpanpemasukan')->name('simpanpemasukan');

			Route::get('/pemasukan-hutang/{type}', 'anggotaController@pemasukanhutang')->name('pemasukanhutang');

			Route::get('/pengeluaran-magang/{type}', 'anggotaController@pengeluaranmagang')->name('pengeluaranmagang');
			Route::post('/Hapus-pelayan', 'anggotaController@Hapus_pelayan')->name('Hapus_pelayan');




			Route::get('/hajatan', 'anggotaController@dataUndangan')->name('anggotaundangan');
			Route::post('/undangan/load-Kondangan', 'anggotaController@loadundangan')->name('anggotaloadundangan');

			Route::post('/undangan/simpan-kondangan', 'anggotaController@simpankondangan')->name('anggotasimpanundangan');


			Route::post('/undangan/hapuskondangan', 'anggotaController@hapusundangan')->name('hapusundangan2');
		});
	});
	// anggota area
});
