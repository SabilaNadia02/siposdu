<?php

use App\Http\Controllers\DataImunisasiController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\DataSkriningController;
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


// Route Pendaftaran
Route::resource('pendaftaran', PendaftaranController::class);

// Route Pencatatan
Route::group(['prefix' => 'pencatatan', 'as' => 'pencatatan.'], function () {
    Route::resource('general', PencatatanGeneralController::class);
    Route::resource('ibu', PencatatanIbuController::class);
    Route::resource('balita', PencatatanBalitaController::class);
    Route::resource('lansia', PencatatanLansiaController::class);

    // 🔹 Kunjungan untuk Ibu
    Route::group(['prefix' => 'ibu/{id_pencatatan_awal}/kunjungan', 'as' => 'ibu.kunjungan.'], function () {
        Route::get('/', [PencatatanIbuController::class, 'indexKunjungan'])->name('index');
        Route::get('/create', [PencatatanIbuController::class, 'createKunjungan'])->name('create');
        Route::post('/', [PencatatanIbuController::class, 'storeKunjungan'])->name('store');
        Route::get('/{id}', [PencatatanIbuController::class, 'showKunjungan'])->name('show');
        Route::get('/{id}/edit', [PencatatanIbuController::class, 'editKunjungan'])->name('edit');
        Route::put('/{id}', [PencatatanIbuController::class, 'updateKunjungan'])->name('update');
        Route::delete('/{id}', [PencatatanIbuController::class, 'destroyKunjungan'])->name('destroy');
    });

    // 🔹 Kunjungan untuk Balita
    Route::group(['prefix' => 'balita/{id_pencatatan_awal}/kunjungan', 'as' => 'balita.kunjungan.'], function () {
        Route::get('/', [PencatatanBalitaController::class, 'indexKunjungan'])->name('index');
        Route::get('/create', [PencatatanBalitaController::class, 'createKunjungan'])->name('create');
        Route::post('/', [PencatatanBalitaController::class, 'storeKunjungan'])->name('store');
        Route::get('/{id}', [PencatatanBalitaController::class, 'showKunjungan'])->name('show');
        Route::get('/{id}/edit', [PencatatanBalitaController::class, 'editKunjungan'])->name('edit');
        Route::put('/{id}', [PencatatanBalitaController::class, 'updateKunjungan'])->name('update');
        Route::delete('/{id}', [PencatatanBalitaController::class, 'destroyKunjungan'])->name('destroy');
    });

    // 🔹 Kunjungan untuk Lansia
    Route::group(['prefix' => 'lansia/{id_pencatatan_awal}/kunjungan', 'as' => 'lansia.kunjungan.'], function () {
        Route::get('/', [PencatatanLansiaController::class, 'indexKunjungan'])->name('index');
        Route::get('/create', [PencatatanLansiaController::class, 'createKunjungan'])->name('create');
        Route::post('/', [PencatatanLansiaController::class, 'storeKunjungan'])->name('store');
        Route::get('/{id}', [PencatatanLansiaController::class, 'showKunjungan'])->name('show');
        Route::get('/{id}/edit', [PencatatanLansiaController::class, 'editKunjungan'])->name('edit');
        Route::put('/{id}', [PencatatanLansiaController::class, 'updateKunjungan'])->name('update');
        Route::delete('/{id}', [PencatatanLansiaController::class, 'destroyKunjungan'])->name('destroy');
    });
});

// Route::group(['prefix' => 'pencatatan', 'as' => 'pencatatan.'], function () {
//     Route::resource('general', PencatatanGeneralController::class);
//     Route::resource('ibu', PencatatanIbuController::class);
//     Route::resource('balita', PencatatanBalitaController::class);
//     Route::resource('lansia', PencatatanLansiaController::class);

//     // Routes untuk kunjungan ibu hamil
//     Route::get('/kunjungan/{id}', [PencatatanIbuController::class, 'showKunjungan'])->name('kunjungan.show');
//     Route::get('/kunjungan/{id}/edit', [PencatatanIbuController::class, 'editKunjungan'])->name('kunjungan.edit');
//     Route::put('/kunjungan/{id}', [PencatatanIbuController::class, 'updateKunjungan'])->name('kunjungan.update');
//     Route::delete('/kunjungan/{id}', [PencatatanIbuController::class, 'destroyKunjungan'])->name('kunjungan.destroy');
// });

// Route Rujukan
Route::resource('rujukan', RujukanController::class);

// Route Kelulusan Balita
Route::resource('kelulusan-balita', KelulusanBalitaController::class);

// Route Pemberian
Route::group(['prefix' => 'pemberian', 'as' => 'pemberian.'], function () {
    Route::resource('imunisasi', PemberianImunisasiController::class);
    Route::resource('vitamin', PemberianVitaminController::class);
    Route::resource('obat', PemberianObatController::class);
    Route::resource('vaksin', PemberianVaksinController::class);
});

// Route Data Master
Route::group(['prefix' => 'data-master', 'as' => 'data-master.'], function () {
    Route::resource('imunisasi', DataImunisasiController::class);
    Route::resource('vitamin', DataVitaminController::class);
    Route::resource('obat', DataObatController::class);
    Route::resource('vaksin', DataVaksinController::class);
    // Route::resource('skrining', DataSkriningController::class);
    // Route::resource('pertanyaan', DataPertanyaanController::class);
    // Route::resource('pertanyaan-skrining', DataPertanyaanSkriningController::class);
    Route::resource('posyandu', DataPosyanduController::class);
    Route::resource('pengguna', DataPenggunaController::class);
});

// Route Skrining
Route::group(['prefix' => 'skrining', 'as' => 'skrining.'], function () {
    Route::resource('tbc', SkriningTBCController::class);
    Route::resource('ppok', SkriningPPOKController::class);
});
