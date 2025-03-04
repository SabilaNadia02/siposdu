<?php

use App\Models\DataPertanyaan;
use App\Models\DataSkrining;
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
        Schema::create('pertanyaan_skrinings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DataSkrining::class, 'id_skrining')->nullable()->constrained('data_skrinings')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(DataPertanyaan::class, 'id_pertanyaan')->nullable()->constrained('data_pertanyaans')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_skrinings');
    }
};
