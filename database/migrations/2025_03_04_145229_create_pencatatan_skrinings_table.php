<?php

use App\Models\DataSkrining;
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
        Schema::create('pencatatan_skrinings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DataSkrining::class, 'id_skrining')->nullable()->constrained('data_skrinings')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Pendaftaran::class, 'no_pendaftaran')->nullable()->constrained('pendaftarans')->nullOnDelete()->cascadeOnUpdate();
            $table->date('waktu_skrining');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_skrinings');
    }
};
