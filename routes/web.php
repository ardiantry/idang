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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function (){ 
	// admin Area
	Route::group(['middleware' => 'AdminMiddleware'], function (){
		Route::group(['prefix' => 'admin'], function () { 
			Route::group(['namespace' => 'Admin'], function () {
				Route::get('/', function () {
					return  redirect('admin/home');	 
				});
				Route::get('/home', 'adminController@home');
				Route::get('/list-anggota', 'adminController@listanggota')->name('listanggota');
				Route::get('/data-Undangan', 'adminController@dataUndangan')->name('dataUndangan');
				

			});  
		});
	});
	// admin Area

	// anggota area
	Route::group(['prefix' => 'anggota'], function () { 
		Route::group(['namespace' => 'Anggota'], function () {
		Route::get('/', function () {
			return  redirect('/anggota/home');	 
		});
		Route::get('/home', 'anggotaController@home');
		Route::get('/kondangan', 'anggotaController@kondangan')->name('anggotakondangan');
		Route::post('/kondangan/simpan-kondangan', 'anggotaController@simpankondangan')->name('simpankondangan');
		Route::post('/kondangan/load-Kondangan', 'anggotaController@loadKondangan')->name('loadKondangan');
		Route::post('/kondangan/hapus-kondangan', 'anggotaController@hapuskondangan')->name('hapuskondangan'); 
		Route::get('/kondangan/detail/{id_kondangan}', 'anggotaController@detailkondangan'); 
 
		Route::get('/kondangan/tamu/{id_tamu}', 'anggotaController@listtamu')->name('listtamu');
		Route::post('/kondangan/tamu/simpan-tamu', 'anggotaController@simpantamu')->name('simpantamu');
		Route::post('/kondangan/tamu/hapus-tamu', 'anggotaController@hapustamu')->name('hapustamu');

		Route::get('/chat-anggota', 'chatController@chatanggota')->name('chatanggota');
		Route::post('/chat-anggota/Kirim-chat', 'chatController@KirimChat')->name('KirimChat');
		Route::post('/chat-anggota/list-chat', 'chatController@listChat')->name('listChat');




	 


		
		});
	});
	// anggota area
});


