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
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('no_jkn');
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
