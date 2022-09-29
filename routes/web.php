<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterCont;
use App\Http\Controllers\LembagaCont;
use App\Http\Controllers\ExportCont;
use App\Http\Controllers\ImportCont;
use App\Http\Controllers\GuruCont;
use App\Http\Controllers\SantriCont;

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
    // return view('welcome');
    // return view('page.dashboard');
    return redirect('/login');
});

Auth::routes();

Route::get('/select-kabupaten-kota',[RegisterCont::class, 'fetch_kabupaten_kota']);
Route::post('/registrasi-lembaga-baru',[RegisterCont::class, 'registrasi_lembaga']);

Route::group(['middleware' => ['auth', 'CheckRole:lembaga']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //guru
    Route::get('/create-new-guru',[GuruCont::class,'create_guru']);
    Route::post('/store-guru',[GuruCont::class,'store_guru']);
    Route::get('/daftar-guru',[GuruCont::class,'daftar_guru']);
    
    //santri
    Route::get('/create-new-santri',[SantriCont::class,'create_santri']);
    Route::post('/store-santri',[SantriCont::class,'store_santri']);
    Route::get('/daftar-santri',[SantriCont::class,'daftar_santri']);

    //export
    Route::get('/export-template-guru',[ExportCont::class,'export_template_guru']);
    Route::get('/export-template-santri',[ExportCont::class,'export_template_santri']);
    Route::post('/import-template-guru',[ImportCont::class,'import_template_data_guru'])->name('import.guru');
    Route::post('/import-template-santri',[ImportCont::class,'import_template_data_santri'])->name('import.santri');

    Route::get('/total_santri_guru_tahun_ini',[LembagaCont::class,'total_santri_guru_tahun_ini']);
    Route::get('/download-sertifikat/{id}',[LembagaCont::class,'download_sertifikat']);
});