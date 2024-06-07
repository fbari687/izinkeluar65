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
        Schema::create('perizinan_guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perizinan_siswa_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('status_perizinan_id');
            $table->unsignedBigInteger('keterangan_perizinan_id');
            $table->timestamps();

            $table->foreign('perizinan_siswa_id')->references('id')->on('perizinan_siswa')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_perizinan_id')->references('id')->on('status_perizinan')->onDelete('cascade');
            $table->foreign('keterangan_perizinan_id')->references('id')->on('keterangan_perizinan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan_guru');
    }
};
