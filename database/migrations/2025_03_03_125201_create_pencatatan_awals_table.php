<?php

use App\Models\DataPosyandu;
use App\Models\Pendaftaran;
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
        Schema::create('pencatatan_awals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pendaftaran::class, 'no_pendaftaran')->nullable()->constrained('pendaftarans')->onDelete('cascade')->onUpdate('cascade');
            $table->date('hpht')->nullable();
            $table->date('htp')->nullable();
            $table->integer('usia_kehamilan')->nullable();
            $table->string('nama_suami')->nullable();
            $table->integer('hamil_ke')->nullable();
            $table->integer('jarak_anak')->nullable();
            $table->float('tinggi_badan')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->float('berat_badan_lahir')->nullable();
            $table->float('panjang_badan_lahir')->nullable();
            $table->enum('status_balita', [1, 2])->nullable();
            $table->longText('riwayat_keluarga')->nullable();
            $table->longText('riwayat_diri_sendiri')->nullable();
            $table->longText('perilaku_berisiko')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_awals');
    }
};
