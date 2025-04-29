<?php

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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama');
            $table->enum('jenis_kelamin', [1, 2]);
            $table->enum('status_perkawinan', [1, 2]);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('pendidikan', [1, 2, 3, 4, 5, 6]);
            $table->enum('pekerjaan', [1, 2, 3, 4, 5, 6, 7]);
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('no_jkn')->nullable();
            $table->enum('jenis_sasaran', [1, 2, 3]);
            $table->foreignId('data_posyandu_id')->nullable()->constrained('data_posyandus')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
