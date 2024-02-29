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
        Schema::create('wa_groups', function (Blueprint $table) {
            $table->id('wa_group_id');
            $table->unsignedBigInteger('rt_id')->nullable();
            $table->string('group_data_id')->unique();
            $table->string('group_nama');
            $table->enum('izin', ['Belum Berizin', 'Berizin'])->default('Belum Berizin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wa_groups');
    }
};
