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
            $table->foreignIdFor(PencatatanAwal::class, 'id_pencatatan_awal')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->date('waktu_pencatatan');
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
