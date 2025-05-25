<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->enum('jenis_kelamin', [1, 2])->nullable();
            $table->enum('status_perkawinan', [1, 2])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('pendidikan', [1, 2, 3, 4, 5, 6])->nullable();
            $table->enum('pekerjaan', [1, 2, 3, 4, 5, 6, 7])->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_jkn')->nullable();
            $table->enum('jenis_sasaran', [1, 2, 3])->nullable();
            $table->foreignId('data_posyandu_id')->nullable()->constrained('data_posyandus')->onDelete('cascade')->onUpdate('cascade')->nullable();
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
