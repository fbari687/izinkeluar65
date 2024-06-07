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
        Schema::create('perizinan_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->text('alasan');
            $table->unsignedBigInteger('status_perizinan_id');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_perizinan_id')->references('id')->on('status_perizinan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_siswa');
    }
};
