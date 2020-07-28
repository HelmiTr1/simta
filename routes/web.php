<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
    // Alert::warning("OK");
    // echo "test";
    return redirect()->route('home');
});


//User
// Route::get('/user','UserController@index');
// Route::get('user/create','UserController@create');
// Route::get('user/{user}/edit','UserController@edit');
// Route::post('user','UserController@store');
// Route::delete('user/{user}','UserController@destroy');
// Route::patch('user/{user}','UserController@update');

//User Management
Route::resource('user', 'UserController')->except('show');
Route::resource('menu', 'MenuController')->except('show');
Route::resource('content', 'ContentController')->except('show');


//Sidang
Route::get('sidang','SidangController@index')->name('sidang');
Route::resource('sidang/hari','HariController')->except('show','create','destroy','store','edit');
Route::resource('sidang/waktu','WaktuController')->except('show','create','destroy','store','edit');
Route::resource('sidang/waktusidang','WaktusidangController')->except('show','create','destroy','store','edit');
Route::get('sidang/jadwal/result','JadwalController@result');
Route::get('sidang/jadwal/detail','JadwalController@detail');
Route::resource('sidang/jadwal','JadwalController');
Route::resource('sidang/ruangan','RuanganController')->except('show');
Route::get('sidang/nilai/rekap', 'NilaiController@rekap')->name('nilai.rekap');
Route::get('sidang/nilai/cetak', 'NilaiController@cetak')->name('nilai.cetak');
Route::get('sidang/nilai/mahasiswa', 'NilaiController@detail')->name('nilai.mahasiswa');
Route::resource('sidang/nilai', 'NilaiController');


//berkas
Route::resource('berkas/revisi', 'RevisiController')->except('create','edit')->name('GET','berkas.revisi');
Route::get('berkas', 'BerkasController@index')->name('berkas');
Route::get('berkas/{berkas}', 'BerkasController@show');
Route::post('berkas', 'BerkasController@store');
Route::delete('berkas/{revisi}', 'BerkasController@destroy');

//Login

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


