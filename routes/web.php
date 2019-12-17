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

use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('logout', 'AuthController@logout');
Auth::routes();

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/dashboard', 'SiswaController@dashboard');
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{id}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('/upload', 'MateriController@upload')->name('upload');
    Route::post('/upload/proses', 'MateriController@proses_upload')->name('uploadproses');
    Route::get('/upload/hapus/{id}', 'MateriController@hapus');
    Route::get('/upload/download/{file}', 'MateriController@download');
    Route::get('/matapel', 'SiswaController@addmapel');
    Route::post('/matapel/store', 'SiswaController@storemapel');
    Route::get('/matapel/{id}/editmatapel', 'SiswaController@editmapel');
    Route::post('/matapel/{id}/update', 'SiswaController@updatemapel');
    Route::get('/matapel/{id}/delete', 'SiswaController@deletemapel');   
    Route::get('/guru','GuruController@index');
    Route::post('/guru/create','GuruController@create');
    Route::get('/guru/{id}/edit','GuruController@edit');
    Route::post('/guru/{id}/update','GuruController@update');
    Route::get('/guru/{id}/delete','GuruController@destroy');
});
Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {
    Route::get('/dashboard', 'SiswaController@dashboard');
    Route::get('/user/{user_id}/profile', 'SiswaController@profile');
    Route::get('/upload', 'MateriController@upload');
    Route::get('/upload/download/{file}', 'MateriController@download');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,guru']], function () {
    Route::get('/dashboard', 'SiswaController@dashboard');
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{id}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('/upload', 'MateriController@upload')->name('upload');
    Route::post('/upload/proses', 'MateriController@proses_upload')->name('uploadproses');
    Route::get('/upload/hapus/{id}', 'MateriController@hapus');
    Route::get('/upload/download/{file}', 'MateriController@download');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
