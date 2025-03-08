<?php

use App\Models\DataVaksin;
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
        Schema::create('pemberian_vaksins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pendaftaran::class, 'no_pendaftaran')->nullable()->constrained('pendaftarans')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(DataVaksin::class, 'id_vaksin')->nullable()->constrained('data_vaksins')->nullOnDelete()->cascadeOnUpdate();
            $table->date('waktu_pemberian');
            $table->string('dosis');
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberian_vaksins');
    }
};
