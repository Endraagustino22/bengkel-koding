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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id(); // id INT UNSIGNED AUTO_INCREMENT
            $table->unsignedBigInteger('id_user')->unique(); //foreign key ke tabel users
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('no_ktp', 255)->unique();
            $table->string('no_hp', 50);
            $table->string('no_rm', 25);
            $table->timestamps();

            // deklarasi foreign key dengan onDelete cascade
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
