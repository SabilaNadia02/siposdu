<?php

use App\Http\Controllers\DataImunisasiController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\DataVaksinController;
use App\Http\Controllers\DataVitaminController;
use App\Http\Controllers\KelulusanBalitaController;
use App\Http\Controllers\PemberianImunisasiController;
use App\Http\Controllers\PemberianObatController;
use App\Http\Controllers\PemberianVaksinController;
use App\Http\Controllers\PemberianVitaminController;
use App\Http\Controllers\PencatatanBalitaController;
use App\Http\Controllers\PencatatanGeneralController;
use App\Http\Controllers\PencatatanIbuController;
use App\Http\Controllers\PencatatanLansiaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RujukanController;
use App\Http\Controllers\SkriningPPOKController;
use App\Http\Controllers\SkriningTBCController;
use Illuminate\Support\Facades\Route;

Route::resource('pendaftaran', PendaftaranController::class);
Route::group(['prefix' => 'pencatatan', 'as' => 'pencatatan.'], function () {
    Route::resource('general', PencatatanGeneralController::class);
    Route::resource('ibu', PencatatanIbuController::class);
    Route::resource('balita', PencatatanBalitaController::class);
    Route::resource('lansia', PencatatanLansiaController::class);
});
Route::resource('rujukan', RujukanController::class);
Route::resource('kelulusan-balita', KelulusanBalitaController::class);
Route::group(['prefix' => 'pemberian', 'as' => 'pemberian.'], function(){
    Route::resource('imunisasi', PemberianImunisasiController::class);
    Route::resource('vitamin', PemberianVitaminController::class);
    Route::resource('obat', PemberianObatController::class);
    Route::resource('vaksin', PemberianVaksinController::class);
});
Route::group(['prefix' => 'data-master', 'as' => 'data-master.'], function(){
    Route::resource('imunisasi', DataImunisasiController::class);
    Route::resource('vitamin', DataVitaminController::class);
    Route::resource('obat', DataObatController::class);
    Route::resource('vaksin', DataVaksinController::class);
    Route::resource('posyandu', DataPosyanduController::class);
    Route::resource('pengguna', DataPenggunaController::class);
});
Route::group(['prefix' => 'skrining', 'as' => 'skrining.'], function(){
    Route::resource('tbc', SkriningTBCController::class);
    Route::resource('ppok', SkriningPPOKController::class);
});