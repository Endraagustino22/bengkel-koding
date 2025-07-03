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
         Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->unique(); //foreign key ke tabel users
            $table->string('nama', 256);
            $table->string('alamat', 255);
            $table->string('no_hp', 50);
            $table->unsignedBigInteger('id_poli');
            $table->timestamps();

            // Foreign key ke tabel poli (misal tabel poli sudah ada)
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade');
            // Foreign key ke tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};
