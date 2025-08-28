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
        Schema::create('kejuaraans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kejuaraan');
            $table->string('slug')->unique();
            $table->boolean('open_pendaftaran')->default(true); 
            $table->longText('deskripsi');
            $table->string('poster')->nullable();
            $table->string('logo')->nullable();
            $table->integer('swo');
            $table->string('no_rek')->nullable();
            $table->string('nama_rek')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('link_kejuaraan')->nullable();
            $table->string('link_grup_wa')->nullable();
            $table->boolean('nik')->default(true);
            $table->boolean('nisn')->default(false);
            $table->boolean('asal_sekolah')->default(false);
            $table->boolean('asal_perguruan')->default(false);
            $table->timestamp('pendaftaran_awal')->nullable();
            $table->timestamp('pendaftaran_akhir')->nullable();
            $table->string('tm_lokasi')->nullable();
            $table->timestamp('tm_waktu')->nullable();
            $table->string('pelaksanaan_lokasi')->nullable();
            $table->timestamp('pelaksanaan_awal')->nullable();
            $table->timestamp('pelaksanaan_akhir')->nullable();
            $table->string('cp1_nama')->nullable();
            $table->string('cp1_no')->nullable();
            $table->string('cp2_nama')->nullable();
            $table->string('cp2_no')->nullable();
            $table->string('cp3_nama')->nullable();
            $table->string('cp3_no')->nullable();
            $table->longText('data_tambahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejuaraans');
    }
};
