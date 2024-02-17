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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->text('keperluan');
            // $table->string('nama');
            // $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan']);
            // $table->foreignId('provinsi_lahir_id')->references('provinsi_id')->on('provinsis')->nullable();
            // $table->string('tempat_lahir_lainnya')->nullable();
            // $table->date('tgl_lahir');
            // $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            // $table->string('pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
