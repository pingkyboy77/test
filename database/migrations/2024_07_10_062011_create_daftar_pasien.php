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
        Schema::create('daftar_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('wilayah')->nullable();
            $table->string('nama_pasien')->nullable();
            $table->string('dokter')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('obat')->nullable();
            $table->string('edited_by')->nullable();
            $table->string('tbbb')->nullable();
            $table->string('guldar')->nullable();
            $table->string('tensi')->nullable();
            $table->string('alergi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pasien');
    }
};
