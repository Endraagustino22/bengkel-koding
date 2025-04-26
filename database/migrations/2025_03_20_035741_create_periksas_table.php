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
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pasien')->constrained('users','id');
            $table->foreignId('id_dokter')->constrained('users','id');
            $table->datetime('tgl_periksa')->nullable();
            $table->text('catatan')->nullable();
            $table->float('biaya_periksa')->nullable();
            $table->enum('status', ['sudah diperiksa', 'belum diperiksa'])->default('belum diperiksa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periksas');
    }
};
