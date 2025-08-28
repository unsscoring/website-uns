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
        Schema::create('atlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kontingens_id');
            $table->unsignedBigInteger('ref_kategoris_id');
            $table->unsignedBigInteger('no_pendaftaran');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->timestamp('tanggal_lahir');
            $table->integer('usia');
            $table->string('gender');
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('asal_perguruan')->nullable();
            $table->unsignedBigInteger('status');
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('kontingens_id')->references('id')->on('kontingens')->onDelete('cascade');
            $table->foreign('ref_kategoris_id')->references('id')->on('ref_kategoris')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('ref_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlets');
    }
};
