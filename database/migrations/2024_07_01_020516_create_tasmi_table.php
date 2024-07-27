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
        Schema::create('tasmi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tanggal');
            $table->string('waktu');
            $table->integer('setoran_id');
            $table->integer('setoran_mahasantri_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasmi');
    }
};
