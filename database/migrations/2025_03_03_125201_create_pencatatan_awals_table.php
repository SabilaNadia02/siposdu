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
            $table->foreignIdFor(Pendaftaran::class, 'no_pendaftaran')->nullable()->constrained('pendaftarans')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('jenis_sasaran', [1, 2, 3]);
            $table->foreignIdFor(DataPosyandu::class, 'nama_posyandu')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->date('waktu_pencatatan');
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
