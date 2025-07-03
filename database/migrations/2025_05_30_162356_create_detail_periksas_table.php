<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_periksa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periksa');
            $table->unsignedBigInteger('id_obat');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_periksa')->references('id')->on('periksa')->onDelete('cascade');
            $table->foreign('id_obat')->references('id')->on('obats')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_periksas');
    }
};
