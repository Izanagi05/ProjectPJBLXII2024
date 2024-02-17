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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan'])->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->unsignedBigInteger('provinsi_lahir_id')->nullable();
            $table->string('tempat_lahir_lainnya')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_telp');
            $table->string('pekerjaan')->nullable();
            $table->enum('hubungan', ['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya'])->nullable();
            $table->enum('status_berktp', ['Sudah', 'Belum'])->default('Belum');
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Duda', 'Janda', 'Lainnya'])->nullable();
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->enum('status', ['Online', 'Offline'])->default('Offline');
            $table->enum('edit',['aktif', 'mati'])->default('mati');
            $table->enum('role', ['User', 'Admin'])->default('User');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
