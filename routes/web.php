<?php

use App\Http\Controllers\PencatatanBalitaController;
use App\Http\Controllers\PencatatanController;
use App\Http\Controllers\PencatatanIbuController;
use App\Http\Controllers\PencatatanLansiaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RujukanController;
use Illuminate\Support\Facades\Route;


Route::resource('pendaftaran', PendaftaranController::class);
Route::resource('pencatatan', PencatatanController::class);
// Route::resource('pencatatan.ibu', PencatatanIbuController::class);
// Route::resource('pencatatan.balita', PencatatanBalitaController::class);
// Route::resource('pencatatan.lansia', PencatatanLansiaController::class);

Route::group(['prefix' => 'pencatatan', 'as' => 'pencatatan.'], function () {
    Route::resource('ibu', 'PencatatanIbuController');
    Route::resource('balita', 'PencatatanBalitaController');
    Route::resource('lansia', 'PencatatanLansiaController');
});

Route::resource('rujukan', RujukanController::class);
