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
        Schema::create('detail_pencatatan_awals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PencatatanAwal::class, 'id_pencatatan_awal')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->date('hpht')->nullable();
            $table->date('htp')->nullable();
            $table->string('nama_suami')->nullable();
            $table->integer('hamil_ke')->nullable();
            $table->integer('jarak_anak')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->float('berat_badan_lahir')->nullable();
            $table->float('panjang_badan_lahir')->nullable();
            $table->enum('status_balita', [1, 2])->default(1)->nullable();
            $table->longText('riwayat_keluarga')->nullable()->nullable();
            $table->longText('riwayat_diri_sendiri')->nullable()->nullable();
            $table->longText('perilaku_berisiko')->nullable()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pencatatan_awals');
    }
};
