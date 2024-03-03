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
        Schema::create('tagihan_bulanans', function (Blueprint $table) {
            $table->id('tagihan_bulanan_id');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreignId('tahun_id')->references('tahun_id')->on('tahuns')->onDelete('cascade');
            $table->unsignedInteger('bulan_id');
            $table->foreignId('jenis_iuran_id')->references('jenis_iuran_id')->on('jenis_iurans')->onDelete('cascade');
            $table->enum('status_pembayaran', ['Belum Dibayar','Belum Lunas', 'Lunas'])->default('Belum Dibayar');
            $table->unique(['user_id', 'tahun_id', 'bulan_id', 'jenis_iuran_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_bulanans');
    }
};
