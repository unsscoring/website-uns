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
        Schema::create('kontingen_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kontingens_id');
            $table->unsignedBigInteger('kejuaraan_berkas_id');
            $table->unsignedBigInteger('status');
            $table->string('path_file');
            $table->timestamps();
            $table->foreign('kontingens_id')->references('id')->on('kontingens')->onDelete('cascade');
            $table->foreign('kejuaraan_berkas_id')->references('id')->on('kejuaraan_berkas')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('ref_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontingen_berkas');
    }
};
