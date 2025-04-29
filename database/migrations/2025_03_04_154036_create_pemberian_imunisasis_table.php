<?php

use App\Models\DataImunisasi;
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
        Schema::create('pemberian_imunisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pendaftaran::class, 'no_pendaftaran')->nullable()->constrained('pendaftarans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(DataImunisasi::class, 'id_imunisasi')->nullable()->constrained('data_imunisasis')->onDelete('cascade')->onUpdate('cascade');
            $table->date('waktu_pemberian');
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberian_imunisasis');
    }
};
