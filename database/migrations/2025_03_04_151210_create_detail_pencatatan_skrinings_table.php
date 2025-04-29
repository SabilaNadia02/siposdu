<?php

use App\Models\PencatatanSkrining;
use App\Models\PertanyaanSkrining;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_pencatatan_skrinings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PencatatanSkrining::class, 'id_pencatatan_skrining')
                ->constrained('pencatatan_skrinings')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignIdFor(PertanyaanSkrining::class, 'id_pertanyaan_skrining')
                ->constrained('pertanyaan_skrinings')->onDelete('cascade')->onUpdate('cascade');

            $table->tinyInteger('hasil_skrining')->comment('1: Ya, 2: Tidak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pencatatan_skrinings');
    }
};
