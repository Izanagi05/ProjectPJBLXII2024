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
            $table->unsignedInteger('bulan');
            $table->foreignId('jenis_iuran_id')->references('jenis_iuran_id')->on('jenis_iurans')->onDelete('cascade');
            $table->decimal('jumlah_pembayaran', 15, 2);
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Dibayar Sebagian', 'Lunas'])->default('Belum Dibayar');
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
