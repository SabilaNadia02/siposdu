<?php

use App\Models\PencatatanAwal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pencatatan_kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PencatatanAwal::class, 'id_pencatatan_awal')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->date('waktu_pencatatan');
            $table->float('berat_badan')->nullable();
            $table->float('panjang_badan')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->float('lingkar_lengan')->nullable();
            $table->float('lingkar_kepala')->nullable();
            $table->float('lingkar_perut')->nullable();
            $table->enum('mt_bumil_kek', [1, 2])->nullable();
            $table->enum('kelas_ibu_hamil', [1, 2])->nullable();
            $table->enum('asi_eksklusif', [1, 2])->nullable();
            $table->enum('mp_asi', [1, 2])->nullable();
            $table->enum('mt_pangan_pemulihan', [1, 2])->nullable();
            $table->string('catatan_kesehatan')->nullable();
            $table->enum('tes_mata_kanan', [1, 2])->nullable();
            $table->enum('tes_mata_kiri', [1, 2])->nullable();
            $table->enum('tes_telinga_kanan', [1, 2])->nullable();
            $table->enum('tes_telinga_kiri', [1, 2])->nullable();
            $table->integer('tekanan_darah_sistolik')->nullable();
            $table->integer('tekanan_darah_diastolik')->nullable();
            $table->float('gula_darah')->nullable();
            $table->float('kolestrol')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('edukasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_kunjungans');
    }
};
