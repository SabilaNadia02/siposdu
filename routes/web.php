<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataImunisasiController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\DataPertanyaanController;
use App\Http\Controllers\DataPertanyaanSkriningController;
use App\Http\Controllers\DataPosyanduController;
use App\Http\Controllers\DataSkriningController;
use App\Http\Controllers\DataVaksinController;
use App\Http\Controllers\DataVitaminController;
use App\Http\Controllers\KelulusanBalitaController;
use App\Http\Controllers\LaporanController;
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
use App\Models\DataImunisasi;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Proteksi semua route dengan middleware auth
Route::middleware(['auth'])->group(function () {
    // Route Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Route yang hanya bisa diakses admin
    Route::middleware(['auth', 'role:1'])->group(function () {
        Route::group(['prefix' => 'data-master', 'as' => 'data-master.'], function () {
            Route::resource('imunisasi', DataImunisasiController::class);
            Route::resource('vitamin', DataVitaminController::class);
            Route::resource('obat', DataObatController::class);
            Route::resource('vaksin', DataVaksinController::class);
            Route::resource('skrining', DataSkriningController::class);
            Route::resource('pertanyaan', DataPertanyaanController::class);
            Route::resource('pertanyaan-skrining', DataPertanyaanSkriningController::class)
                ->parameters(['pertanyaan-skrining' => 'pertanyaanSkrining']);
            Route::resource('posyandu', DataPosyanduController::class);
            Route::resource('pengguna', DataPenggunaController::class);
        });
    });

    // Route yang bisa diakses admin dan bidan/perawat
    Route::middleware(['auth', 'role:1,2'])->group(function () {
        Route::resource('rujukan', RujukanController::class);
        Route::get('rujukan/filter', [RujukanController::class, 'filter'])->name('rujukan.filter');

        Route::group(['prefix' => 'pemberian', 'as' => 'pemberian.'], function () {
            Route::get('imunisasi/get-imunisasi-by-usia', [PemberianImunisasiController::class, 'getImunisasiByUsia'])
                ->name('imunisasi.get-imunisasi-by-usia');
            Route::resource('imunisasi', PemberianImunisasiController::class);
            Route::resource('vitamin', PemberianVitaminController::class);
            Route::resource('obat', PemberianObatController::class);
            Route::resource('vaksin', PemberianVaksinController::class);
        });
    });

    // Route yang bisa diakses admin, bidan/perawat, dan kader
    Route::middleware(['auth', 'role:1,2,3'])->group(function () {
        Route::resource('pendaftaran', PendaftaranController::class);

        Route::group(['prefix' => 'pencatatan', 'as' => 'pencatatan.'], function () {
            Route::resource('general', PencatatanGeneralController::class);
            Route::resource('ibu', PencatatanIbuController::class);
            Route::resource('balita', PencatatanBalitaController::class);
            Route::resource('lansia', PencatatanLansiaController::class);

            // Kunjungan untuk Ibu
            Route::group(['prefix' => 'ibu/{id_pencatatan_awal}/kunjungan', 'as' => 'ibu.kunjungan.'], function () {
                Route::post('/', [PencatatanIbuController::class, 'storeKunjungan'])->name('store');
                Route::get('/{id}', [PencatatanIbuController::class, 'showKunjungan'])->name('show');
                Route::get('/{id}/edit', [PencatatanIbuController::class, 'editKunjungan'])->name('edit');
                Route::put('/{id}', [PencatatanIbuController::class, 'updateKunjungan'])->name('update');
                Route::delete('/{id}', [PencatatanIbuController::class, 'destroyKunjungan'])->name('destroy');
            });

            // Kunjungan untuk Balita
            Route::group(['prefix' => 'balita/{id_pencatatan_awal}/kunjungan', 'as' => 'balita.kunjungan.'], function () {
                Route::post('/', [PencatatanBalitaController::class, 'storeKunjungan'])->name('store');
                Route::get('/{id}', [PencatatanBalitaController::class, 'showKunjungan'])->name('show');
                Route::get('/{id}/edit', [PencatatanBalitaController::class, 'editKunjungan'])->name('edit');
                Route::put('/{id}', [PencatatanBalitaController::class, 'updateKunjungan'])->name('update');
                Route::delete('/{id}', [PencatatanBalitaController::class, 'destroyKunjungan'])->name('destroy');
            });

            // Kunjungan untuk Lansia
            Route::group(['prefix' => 'lansia/{id_pencatatan_awal}/kunjungan', 'as' => 'lansia.kunjungan.'], function () {
                Route::post('/', [PencatatanLansiaController::class, 'storeKunjungan'])->name('store');
                Route::get('/{id}', [PencatatanLansiaController::class, 'showKunjungan'])->name('show');
                Route::get('/{id}/edit', [PencatatanLansiaController::class, 'editKunjungan'])->name('edit');
                Route::put('/{id}', [PencatatanLansiaController::class, 'updateKunjungan'])->name('update');
                Route::delete('/{id}', [PencatatanLansiaController::class, 'destroyKunjungan'])->name('destroy');
            });
        });

        Route::resource('kelulusan-balita', KelulusanBalitaController::class);

        Route::group(['prefix' => 'skrining', 'as' => 'skrining.'], function () {
            Route::resource('tbc', SkriningTBCController::class);
            Route::resource('ppok', SkriningPPOKController::class);
        });

        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('index');
            Route::get('/generate', [LaporanController::class, 'generatePDF'])->name('generate');
            Route::resource('data', LaporanController::class)->except(['index', 'create', 'show']);
        });

        Route::get('/test-role', function () {
            return 'Bisa masuk, role oke!';
        })->middleware(['auth', 'role:1']);
    });
});

// Testing
Route::get('/test-imunisasi', function () {
    $usia = 10; // Bulan
    return DataImunisasi::where('dari_umur', '<=', $usia)
        ->where('sampai_umur', '>=', $usia)
        ->get();
});

