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
        Schema::create('user_alamats', function (Blueprint $table) {
            $table->id('user_alamat_id');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->foreignId('alamat_id')->references('alamat_id')->on('alamats');
            $table->foreignId('detail_alamat_id')->references('detail_alamat_id')->on('detail_alamats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_alamats');
    }
};
