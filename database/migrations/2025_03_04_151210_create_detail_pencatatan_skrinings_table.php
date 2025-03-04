<?php

use App\Models\PencatatanSkrining;
use App\Models\PertanyaanSkrining;
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
        Schema::create('detail_pencatatan_skrinings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PencatatanSkrining::class, 'id_pencatatan_skrining')->nullable()->constrained('pencatatan_skrinings')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PertanyaanSkrining::class, 'id_pertanyaan_skrining')->nullable()->constrained('pertanyaan_skrinings')->nullOnDelete()->cascadeOnUpdate();
            $table->enum('hasil_skrining', [1, 2]);
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
