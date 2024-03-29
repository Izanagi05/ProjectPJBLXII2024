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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id('pengeluaran_id');
            $table->string('nama_pengeluaran');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_pengeluaran');
            $table->foreignId('rt_id')->references('rt_id')->on('rts');
            $table->unsignedBigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
