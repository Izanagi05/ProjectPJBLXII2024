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
        Schema::create('pembayaran_iurans', function (Blueprint $table) {
            $table->id('pembayaran_iuran_id');
            $table->foreignId('tagihan_bulanan_id')->references('tagihan_bulanan_id')->on('tagihan_bulanans')->onDelete('cascade');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreignId('jenis_iuran_id')->references('jenis_iuran_id')->on('jenis_iurans')->onDelete('cascade');
            $table->foreignId('rt_id')->references('rt_id')->on('rts');
            $table->date('tanggal_pembayaran');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iurans');
    }
};
